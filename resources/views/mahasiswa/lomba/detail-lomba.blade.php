@extends('layout.template')

@section('content')
<main class="flex-1 px-10">
    <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Detail Lomba</h2>
        <div class="max-w-max mx-auto mt-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Poster -->
            <div class="">
                <img src="{{ asset('images/poster.jpeg') }}" alt="Poster Lomba" class="rounded-lg shadow-md w-full" />
            </div>

            <!-- Detail Lomba -->
            <div class="space-y-4">
                <h1 class="text-xl font-bold text-gray-800">{{ $competition->name }}</h1>
                <!-- Tags -->
                <div class="flex flex-wrap gap-2">
                    @foreach ( $competition->tags as $tag)
                    <span class="text-xs text-blue-600 px-2 py-1 border border-blue-500 rounded-md font-medium">
                        #{{ $tag->name }}
                    </span>
                    @endforeach
                </div>

                <hr class="my-6 border-t border-gray-300">

                <!-- Info Kegiatan -->
                <div class=" text-sm text-gray-700 space-y-3">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ Carbon\Carbon::parse($competition->start_at)->format('d F Y') }} -
                        {{ Carbon\Carbon::parse($competition->end_at)->format('d F Y') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                        @if ($competition->registration_fee == 0)
                        Gratis
                        @else
                        Rp {{ number_format($competition->registration_fee, 0, ',', '.') }}
                        @endif
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13-7a4 4 0 01-8 0 4 4 0 018 0zM9 10a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Tim ({{ $competition->max_participation_amount }} Orang)
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ $competition->organizer }}
                    </div>
                </div>

                <hr class="my-6 border-t border-gray-300">

                <!-- Deskripsi -->
                <p class="text-sm font-normal text-gray-700 leading-relaxed">
                    {{ $competition->description }}
                </p>

                <!-- Tombol Daftar -->
                <a href="{{ $competition->registration_link }}"
                    class="animate-bounce mt-4 inline-block bg-[#1e6aae] hover:bg-[#17497C] text-white text-sm font-medium px-4 py-2 rounded-md transition"
                    target="_blank" rel="noopener">
                    Daftar Disini >
                </a>

            </div>
        </div>

    </div>
</main>
@endsection