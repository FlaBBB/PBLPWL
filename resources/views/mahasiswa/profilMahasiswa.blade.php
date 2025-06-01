@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Profil saya</h2>
            <div class="place-content-center flex items-center space-x-8">
                <img src={{ asset('images/user-avatar.jpg') }} alt="Foto Profil"
                    class=" object-center w-32 h-32 rounded-full object-cover" />
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">Dennis Putra Wijaya</h3>
                    <a href="{{ route('edit_profile') }}">
                        <button
                            class="mt-3 px-5 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 transition">
                            Edit Profile
                        </button>
                    </a>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div class="mt-4 border border-gray-300 rounded-lg p-4">
                    <h3 class="font-semibold text-base text-blue-600">Prestasi saya</h3>
                    <ul class="mt-4 text-sm list-disc pl-6 space-y-2">
                        <li>Juara 1 - UI/UX at Hackathon Merdeka Jaya</li>
                        <li>Juara 3 - UI/UX at GENETIC 2025</li>
                        <li>Juara 1 - Infographic at Festival IT Armageddon</li>
                    </ul>
                </div>
                <div class="mt-4 border border-gray-300 rounded-lg p-4">
                    <h3 class="font-semibold text-base text-blue-600">Minat dan Keahlian</h3>
                    <ul class="mt-4 text-sm list-disc pl-6 space-y-2">
                        <li>UI/UX</li>
                        <li>Web Development</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection