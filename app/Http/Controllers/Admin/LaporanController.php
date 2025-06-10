<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Competition;
use App\Models\Mahasiswa;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;




class LaporanController extends Controller
{
    public function index()
    {

        $activeMenu = 'laporan';
        $breadcrumbs = [
            [
                'label' => 'Laporan',
                'url' => route('admin.laporan')
            ],
        ];

        $headerTitle = 'Laporan';
        $headerDesc = 'Kelola dan verifikasi prestasi yang diajukan oleh mahasiswa.';
        // Total Prestasi
        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        $totalAchievementsCurrentYear = Achievement::whereYear('upload_at', $currentYear)->count();
        $totalAchievementsPreviousYear = Achievement::whereYear('upload_at', $previousYear)->count();

        $percentageChange = 0;
        $isIncrease = true;

        if ($totalAchievementsPreviousYear > 0) {
            $percentageChange = (($totalAchievementsCurrentYear - $totalAchievementsPreviousYear) / $totalAchievementsPreviousYear) * 100;
            $isIncrease = $percentageChange >= 0;
            $percentageChange = abs($percentageChange);
        }

        // Total Prestasi (overall)
        $totalAchievements = Achievement::count();

        // Prestasi per Tahun
        $driver = Config::get('database.default');
        $yearFunction = '';

        switch ($driver) {
            case 'pgsql':
                $yearFunction = 'EXTRACT(YEAR FROM achievement.upload_at)';
                break;
            case 'mysql':
                $yearFunction = 'YEAR(achievement.upload_at)';
                break;
            case 'sqlite':
                $yearFunction = 'strftime(\'%Y\', achievement.upload_at)';
                break;
            default:
                // Fallback for unknown drivers, or throw an exception
                $yearFunction = 'YEAR(achievement.upload_at)';
                break;
        }

        $achievementsPerYear = Achievement::select(
            DB::raw("$yearFunction as year"),
            DB::raw('count(*) as total')
        )
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        // Prestasi per Program Studi
        $achievementsPerProdi = Mahasiswa::select(
            'prodi',
            DB::raw('count(DISTINCT mahasiswa_achievement.nim) as total_students'),
            DB::raw('count(achievement.id) as total_achievements')
        )
            ->join('mahasiswa_achievement', 'mahasiswa.nim', '=', 'mahasiswa_achievement.nim')
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->groupBy('prodi')
            ->orderBy('prodi', 'asc')
            ->get();

        // Tingkat Lomba
        $achievementsPerLevel = Competition::select(
            'level',
            DB::raw('count(*) as total')
        )
            ->groupBy('level')
            ->orderBy('level', 'asc')
            ->get();

        // Distribusi Capaian
        $achievementsPerCapaian = Achievement::select(
            DB::raw("CASE
                    WHEN place = 1 THEN 'Juara 1'
                    WHEN place = 2 THEN 'Juara 2'
                    WHEN place = 3 THEN 'Juara 3'
                    ELSE 'Lainnya'
                END as capaian"),
            DB::raw('count(*) as total')
        )
            ->groupBy('capaian')
            ->orderBy('capaian', 'asc')
            ->get();

        // Kategori Lomba
        $achievementsPerCategory = Achievement::select(
            'tag.name as category',
            DB::raw('count(achievement.id) as total')
        )
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $threshold = $totalAchievements * 0.02; // 2% threshold
        $filteredCategories = collect();
        $otherCategoriesTotal = 0;

        foreach ($achievementsPerCategory as $category) {
            if ($category->total >= $threshold) {
                $filteredCategories->push($category);
            } else {
                $otherCategoriesTotal += $category->total;
            }
        }

        if ($otherCategoriesTotal > 0) {
            $filteredCategories->push((object)[
                'category' => 'Lainnya',
                'total' => $otherCategoriesTotal
            ]);
        }

        $achievementsPerCategory = $filteredCategories;

        return view('admin.laporan', compact(
            'headerTitle',
            'headerDesc',
            'activeMenu',
            'breadcrumbs',
            'totalAchievements',
            'achievementsPerYear',
            'achievementsPerProdi',
            'achievementsPerLevel',
            'achievementsPerCapaian',
            'achievementsPerCategory',
            'percentageChange',
            'isIncrease',
        ));
    }

    public function exportPdf()
    {
        $achievementsPerYear = Achievement::select(
            DB::raw('YEAR(upload_at) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $achievementsPerProdi = Mahasiswa::select(
            'prodi',
            DB::raw('count(DISTINCT mahasiswa_achievement.nim) as total_students'),
            DB::raw('count(achievement.id) as total_achievements')
        )
            ->join('mahasiswa_achievement', 'mahasiswa.nim', '=', 'mahasiswa_achievement.nim')
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->groupBy('prodi')
            ->orderBy('prodi', 'asc')
            ->get();

        $achievementsPerLevel = Competition::select(
            'level',
            DB::raw('count(*) as total')
        )
            ->groupBy('level')
            ->orderBy('level', 'asc')
            ->get();

        $achievementsPerCapaian = Achievement::select(
            DB::raw("CASE
                    WHEN place = 1 THEN 'Juara 1'
                    WHEN place = 2 THEN 'Juara 2'
                    WHEN place = 3 THEN 'Juara 3'
                    ELSE 'Lainnya'
                END as capaian"),
            DB::raw('count(*) as total')
        )
            ->groupBy('capaian')
            ->orderBy('capaian', 'asc')
            ->get();

        $achievementsPerCategory = Achievement::select(
            'tag.name as category',
            DB::raw('count(achievement.id) as total')
        )
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        $data = [
            'achievementsPerYear' => $achievementsPerYear,
            'achievementsPerProdi' => $achievementsPerProdi,
            'achievementsPerLevel' => $achievementsPerLevel,
            'achievementsPerCapaian' => $achievementsPerCapaian,
            'achievementsPerCategory' => $achievementsPerCategory,
        ];

        $pdf = Pdf::loadView('admin.laporan_pdf', $data);
        return $pdf->download('Laporan-Analitik-Prestasi_' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel()
    {
        // =================================================================
        // PENGAMBILAN DATA (SESUAI FUNGSI exportPdf ANDA)
        // =================================================================

        $achievementsPerYear = Achievement::select(
            DB::raw('YEAR(upload_at) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $achievementsPerProdi = Mahasiswa::select(
            'prodi',
            DB::raw('count(DISTINCT mahasiswa_achievement.nim) as total_students'),
            DB::raw('count(achievement.id) as total_achievements')
        )
            ->join('mahasiswa_achievement', 'mahasiswa.nim', '=', 'mahasiswa_achievement.nim')
            ->join('achievement', 'mahasiswa_achievement.id_achievement', '=', 'achievement.id')
            ->groupBy('prodi')
            ->orderBy('prodi', 'asc')
            ->get();

        $achievementsPerLevel = Competition::select(
            'level',
            DB::raw('count(*) as total')
        )
            ->groupBy('level')
            ->orderBy('level', 'asc')
            ->get();

        $achievementsPerCapaian = Achievement::select(
            DB::raw("CASE
                        WHEN place = 1 THEN 'Juara 1'
                        WHEN place = 2 THEN 'Juara 2'
                        WHEN place = 3 THEN 'Juara 3'
                        ELSE 'Lainnya'
                    END as capaian"),
            DB::raw('count(*) as total')
        )
            ->groupBy('capaian')
            ->orderBy('capaian', 'asc')
            ->get();

        $achievementsPerCategory = Achievement::select(
            'tag.name as category',
            DB::raw('count(achievement.id) as total')
        )
            ->join('mahasiswa_achievement', 'achievement.id', '=', 'mahasiswa_achievement.id_achievement')
            ->join('tag', 'mahasiswa_achievement.id_tag', '=', 'tag.id')
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // =================================================================
        // BAGIAN MEMBUAT FILE EXCEL (DISESUAIKAN DENGAN DATA BARU)
        // =================================================================

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Laporan Prestasi Mahasiswa');

        // --- Sheet 1: Prestasi per Tahun ---
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Per Tahun');
        $sheet1->setCellValue('A1', 'Tahun');
        $sheet1->setCellValue('B1', 'Jumlah Prestasi');
        $row = 2;
        foreach ($achievementsPerYear as $data) {
            $sheet1->setCellValue('A' . $row, $data->year);
            $sheet1->setCellValue('B' . $row, $data->total);
            $row++;
        }
        $sheet1->getColumnDimension('A')->setAutoSize(true);
        $sheet1->getColumnDimension('B')->setAutoSize(true);

        // --- Sheet 2: Prestasi per Prodi --- (DISESUAIKAN DENGAN 3 KOLOM)
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Per Prodi');
        $sheet2->setCellValue('A1', 'Program Studi');
        $sheet2->setCellValue('B1', 'Jumlah Mahasiswa Berprestasi');
        $sheet2->setCellValue('C1', 'Total Prestasi');
        $row = 2;
        foreach ($achievementsPerProdi as $data) {
            $sheet2->setCellValue('A' . $row, $data->prodi);
            $sheet2->setCellValue('B' . $row, $data->total_students);
            $sheet2->setCellValue('C' . $row, $data->total_achievements);
            $row++;
        }
        $sheet2->getColumnDimension('A')->setAutoSize(true);
        $sheet2->getColumnDimension('B')->setAutoSize(true);
        $sheet2->getColumnDimension('C')->setAutoSize(true);


        // --- Sheet 3: Tingkat Lomba ---
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Tingkat Lomba');
        $sheet3->setCellValue('A1', 'Tingkat');
        $sheet3->setCellValue('B1', 'Jumlah Prestasi');
        $row = 2;
        foreach ($achievementsPerLevel as $data) {
            $sheet3->setCellValue('A' . $row, $data->level->value); // Langsung dari kolom level
            $sheet3->setCellValue('B' . $row, $data->total);
            $row++;
        }
        $sheet3->getColumnDimension('A')->setAutoSize(true);
        $sheet3->getColumnDimension('B')->setAutoSize(true);


        // --- Sheet 4: Distribusi Capaian ---
        $sheet4 = $spreadsheet->createSheet();
        $sheet4->setTitle('Distribusi Capaian');
        $sheet4->setCellValue('A1', 'Capaian');
        $sheet4->setCellValue('B1', 'Jumlah Prestasi');
        $row = 2;
        foreach ($achievementsPerCapaian as $data) {
            $sheet4->setCellValue('A' . $row, $data->capaian); // Sudah di-format oleh query CASE
            $sheet4->setCellValue('B' . $row, $data->total);
            $row++;
        }
        $sheet4->getColumnDimension('A')->setAutoSize(true);
        $sheet4->getColumnDimension('B')->setAutoSize(true);


        // --- Sheet 5: Kategori Lomba ---
        $sheet5 = $spreadsheet->createSheet();
        $sheet5->setTitle('Kategori Lomba');
        $sheet5->setCellValue('A1', 'Kategori');
        $sheet5->setCellValue('B1', 'Jumlah Prestasi');
        $row = 2;
        foreach ($achievementsPerCategory as $data) {
            $sheet5->setCellValue('A' . $row, $data->category);
            $sheet5->setCellValue('B' . $row, $data->total);
            $row++;
        }
        $sheet5->getColumnDimension('A')->setAutoSize(true);
        $sheet5->getColumnDimension('B')->setAutoSize(true);


        // --- Proses Export ---
        $spreadsheet->setActiveSheetIndex(0);
        $filename = 'Laporan-Analitik-Prestasi_' . date('Y-m-d') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
