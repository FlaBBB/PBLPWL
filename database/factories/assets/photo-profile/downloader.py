import os
import time
from concurrent.futures import ThreadPoolExecutor
from io import BytesIO
from urllib.parse import urlparse

import requests
from PIL import Image


def compress_image(image_data, quality=75):
    """Compress image data using PIL"""
    try:
        # Open image from binary data
        img = Image.open(BytesIO(image_data))
        
        # Convert to RGB if image is in RGBA mode
        if img.mode in ('RGBA', 'P'):
            img = img.convert('RGB')
        
        # Create BytesIO object to store compressed image
        output = BytesIO()
        
        # Save with compression
        img.save(output, format='JPEG', quality=quality, optimize=True)
        
        return output.getvalue()
    except Exception as e:
        print(f"Error compressing image: {str(e)}")
        return image_data  # Return original data if compression fails

def download_file(url, filename, output_dir='downloads', compress=True, quality=75):
    try:
        # Create output directory if it doesn't exist
        os.makedirs(output_dir, exist_ok=True)
        
        output_path = os.path.join(output_dir, filename)
        
        # Download with progress tracking
        response = requests.get(url, stream=True)
        response.raise_for_status()
        
        total_size = int(response.headers.get('content-length', 0))
        
        print(f'Downloading {filename}...')
        
        # Download the file content
        content = BytesIO()
        downloaded = 0
        for chunk in response.iter_content(chunk_size=8192):
            if chunk:
                content.write(chunk)
                downloaded += len(chunk)
        
        # Get the full content as bytes
        content_bytes = content.getvalue()
        original_size = len(content_bytes)

        # Compress if it's an image
        if compress and filename.lower().endswith(('.jpg', '.jpeg', '.png')):
            print(f'Compressing {filename}...')
            compressed_content = compress_image(content_bytes, quality)
            
            # Calculate compression ratio
            compressed_size = len(compressed_content)
            ratio = (1 - compressed_size / original_size) * 100
            print(f'Compressed {filename} by {ratio:.1f}%')
            
            # Use compressed content
            final_content = compressed_content
        else:
            # Use original content
            final_content = content_bytes
        
        # Save the final content
        with open(output_path, 'wb') as f:
            f.write(final_content)
                
        print(f'Successfully processed: {filename}')
        return True
    
    except Exception as e:
        print(f'Error processing {url}: {str(e)}')
        return False

if __name__ == "__main__":
    url = "https://thispersondoesnotexist.com/"
    
    for i in range(1000):
        download_file(url, f"person_{i}.jpg", output_dir='.', compress=True, quality=75)