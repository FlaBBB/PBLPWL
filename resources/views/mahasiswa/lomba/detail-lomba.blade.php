@extends('layout.template')

@section('content')
    <main class="flex-1 p-10">
        <div class="w-full mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Detail Lomba</h2>
            <div class="max-w-max mx-auto mt-8 px-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Poster -->
                <div class="">
                    <img src="{{ asset('images/poster.jpeg') }}" alt="Poster Lomba" class="rounded-lg shadow-md w-full" />
                </div>

                <!-- Detail Lomba -->
                <div class="space-y-4">
                    <h1 class="text-xl font-bold text-gray-800">Hackathon Merdeka Jawa</h1>
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs text-blue-600 px-2 py-1 border border-blue-500 rounded-md font-medium">#Cyber
                            Security</span>
                        <span class="text-xs text-blue-600 px-2 py-1 border border-blue-500 rounded-md font-medium">#Internet
                            of Thing (IoT)</span>
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
                            21 Agustus - 22 Agustus 2020
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                            Gratis
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13-7a4 4 0 01-8 0 4 4 0 018 0zM9 10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Tim (4 Orang)
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Institut Teknologi Guatemala
                        </div>
                    </div>
                    
                    <hr class="my-6 border-t border-gray-300">

                    <!-- Deskripsi -->
                    <p class="text-sm font-normal text-gray-700 leading-relaxed">
                        Hackathon Merdeka Jawa adalah ajang kompetisi inovasi digital yang mengundang para developer,
                        desainer, mahasiswa, profesional teknologi, dan penggiat startup dari seluruh wilayah Pulau Jawa
                        untuk berkolaborasi menciptakan solusi berbasis teknologi yang berdampak nyata. Dengan mengusung
                        semangat kemerdekaan, acara ini menjadi ruang untuk mengeksplorasi ide-ide kreatif dan menjawab
                        tantangan sosial, ekonomi, serta lingkungan yang dihadapi masyarakat Indonesia, khususnya di Jawa.
                        Peserta akan membentuk tim, mengembangkan prototipe selama periode hackathon, dan mempresentasikan
                        hasilnya di hadapan dewan juri. Selain menjadi ajang kompetitif, Hackathon Merdeka Jawa juga
                        bertujuan untuk membangun ekosistem inovasi yang inklusif, mendorong kolaborasi antar bidang, dan
                        memperkuat kontribusi teknologi dalam pembangunan nasional.
                    </p>

                    <!-- Tombol Daftar -->
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSecW2eC8p2yDu-dfIBWbp3f3LwD1HTFRci4mMDXhiQcTU97cA/viewform?usp=sharing&ouid=110660533517399513573"
                        class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-md transition"
                        target="_blank" rel="noopener">
                        Daftar Disini
                    </a>

                </div>
            </div>

        </div>
    </main>
@endsection