{{-- filepath: resources/views/admin/laporan_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Prestasi</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; }
        h2, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background: #eee; }
        .section { margin-top: 40px; }
    </style>
</head>
<body>
    <h2>Laporan Prestasi</h2>
    {{-- Prestasi per Tahun --}}
    <div class="section">
        <h3>Prestasi per Tahun</h3>
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
        <h3>Prestasi per Program Studi</h3>
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
        <h3>Tingkat Lomba</h3>
        <table>
            <thead>
                <tr>
                    <th>Tingkat</th>
                    <th>Jumlah Prestasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($achievementsPerLevel as $data)
                    <tr>
                        <td>
                            @php
                                $levelLabels = [
                                    'INTERNAL' => 'Internal',
                                    'CITY' => 'Kota/ Kabupaten',
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
        <h3>Distribusi Capaian</h3>
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
        <h3>Kategori Lomba</h3>
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
</body>
</html>