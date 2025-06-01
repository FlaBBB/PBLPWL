@extends('layout.template')

@section('content')
<main class="flex-1 px-10 pb-10">
    <header class="flex items-center justify-between py-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $headerTitle }}</h1>
            <p class="text-sm text-gray-500">{{ $headerDesc }}</p>
        </div>
        <nav class="text-sm text-gray-500">
            @foreach($breadcrumbs as $breadcrumb)
                @if(!$loop->last)
                    <a href="{{ $breadcrumb['url'] }}" class="hover:underline">{{ $breadcrumb['label'] }}</a> >
                @else
                    <span>{{ $breadcrumb['label'] }}</span>
                @endif
            @endforeach
        </nav>
    </header>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-bold text-lg mb-4">Detail Lomba: {{ $lomba['name'] }}</h2>
        <p>ID Lomba: {{ $lomba['id'] }}</p>
        <p>This is a placeholder for the lomba details page.</p>
        <a href="{{ route('admin.daftar-lomba') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Back to Daftar Lomba</a>
    </div>
</main>
@endsection
