<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Prestasi Mahasiswa</title>
    <style>
        /* Mengatur halaman untuk PDF */
        @page {
            margin: 1in;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #333;
        }

        /* --- FOOTER --- */
        #footer {
            position: fixed;
            bottom: -0.6in;
            /* Tarik ke bawah di luar margin */
            left: 0;
            right: 0;
            height: 50px;
            border-top: 1px solid #000;
            text-align: center;
            font-size: 10pt;
            color: #777;
        }

        /* --- KONTEN UTAMA --- */
        main {
        }

        .report-title {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 40px;
        }

        .report-title h3 {
            font-size: 18pt;
            text-transform: uppercase;
            font-weight: bold;
            margin: 0;
        }

        .report-title p {
            font-size: 12pt;
            margin-top: 5px;
        }

        .intro-text {
            margin-bottom: 30px;
            text-align: justify;
        }

        .section {
            margin-top: 40px;
            page-break-inside: avoid;
            /* Mencegah tabel terpotong di tengah halaman */
        }

        .section h4 {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }

        .section .description {
            font-size: 11pt;
            font-style: italic;
            color: #555;
            margin-bottom: 15px;
        }

        /* --- GAYA TABEL --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            /* Hanya garis horizontal */
        }

        th {
            background-color: #f2f2f2;
            /* Warna header tabel yang lembut */
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
            border-top: 1px solid #ddd;
        }

        td:first-child {
            width: 60%;
            /* Beri ruang lebih untuk nama/deskripsi */
        }

        td:last-child {
            text-align: center;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div id="footer">
        Laporan Prestasi Mahasiswa | oleh SIPRESTA</span>
    </div>

    <main>
        <div class="report-title">
            <h3>Laporan Prestasi Mahasiswa</h3>
            <p>Periode Tahun {{ date('Y') }}</p>
        </div>

        <p class="intro-text">
            Berikut adalah Laporan rekapitulasi Prestasi Mahasiswa di Jurusan Teknologi Informasi per tanggal
            {{ date('d F Y') }}. Laporan ini mencakup analisis prestasi berdasarkan tahun, program studi, tingkat
            kompetisi, capaian, dan kategori lomba sebagai bahan evaluasi dan dokumentasi.
        </p>

        {{-- Prestasi per Tahun --}}
        <div class="section">
            <h4>Analisis Prestasi per Tahun</h4>
            <p class="description">Tabel berikut menyajikan rekapitulasi jumlah prestasi yang diraih oleh mahasiswa per
                tahun akademik. Data ini menunjukkan tren perkembangan prestasi dari waktu ke waktu.</p>
            <table>
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Jumlah Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievementsPerYear as $data)
                        <tr>
                            <td>{{ $data->year }}</td>
                            <td>{{ $data->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Prestasi per Program Studi --}}
        <div class="section">
            <h4>Distribusi Prestasi per Program Studi</h4>
            <p class="description">Data berikut menampilkan sebaran prestasi mahasiswa berdasarkan program studi. Hal
                ini dapat menjadi indikator keaktifan dan keunggulan kompetitif setiap program studi.</p>
            <table>
                <thead>
                    <tr>
                        <th>Program Studi</th>
                        <th>Jumlah Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievementsPerProdi as $data)
                        <tr>
                            <td>{{ $data->prodi }}</td>
                            <td>{{ $data->total_achievements }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tingkat Lomba --}}
        <div class="section">
            <h4>Klasifikasi Prestasi Berdasarkan Tingkat Kompetisi</h4>
            <p class="description">Tabel ini mengklasifikasikan jumlah prestasi berdasarkan jenjang atau tingkat
                kompetisi, mulai dari internal hingga internasional.</p>
            <table>
                <thead>
                    <tr>
                        <th>Tingkat Kompetisi</th>
                        <th>Jumlah Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievementsPerLevel as $data)
                        <tr>
                            <td>
                                @php
                                    $levelLabels = [
                                        'INTERNAL' => 'Internal Kampus',
                                        'CITY' => 'Kota / Kabupaten',
                                        'PROVINCE' => 'Provinsi',
                                        'NATIONAL' => 'Nasional',
                                        'INTERNATIONAL' => 'Internasional'
                                    ];
                                    $levelValue = is_object($data->level) && property_exists($data->level, 'value') ? $data->level->value : $data->level;
                                @endphp
                                {{ $levelLabels[$levelValue] ?? $levelValue }}
                            </td>
                            <td>{{ $data->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Distribusi Capaian --}}
        <div class="section">
            <h4>Distribusi Berdasarkan Capaian (Peringkat)</h4>
            <p class="description">Analisis berikut merinci distribusi prestasi berdasarkan peringkat yang diperoleh,
                seperti Juara 1, Juara 2, dan sebagainya.</p>
            <table>
                <thead>
                    <tr>
                        <th>Capaian</th>
                        <th>Jumlah Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievementsPerCapaian as $data)
                        <tr>
                            <td>{{ $data->capaian }}</td>
                            <td>{{ $data->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Kategori Lomba --}}
        <div class="section">
            <h4>Distribusi Berdasarkan Kategori Lomba</h4>
            <p class="description">Tabel terakhir ini memetakan prestasi mahasiswa ke dalam berbagai kategori lomba,
                seperti ilmiah, olahraga, seni, dan lainnya.</p>
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achievementsPerCategory as $data)
                        <tr>
                            <td>{{ $data->category }}</td>
                            <td>{{ $data->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </main>
</body>

</html>