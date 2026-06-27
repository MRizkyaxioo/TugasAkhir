<?php

namespace App\Exports;

use App\Models\PresensiPeserta;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapPresensiExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithCustomStartCell
{
    protected $bulan;
    protected $nama;
    protected $tanggal;

    public function __construct($bulan = null, $tanggal = null, $nama = null)
    {
        $this->bulan = $bulan;
        $this->tanggal = $tanggal;
        $this->nama = $nama;
    }

    public function collection()
    {
        $query = PresensiPeserta::select(
            'id_peserta',
            DB::raw("SUM(status_kehadiran='hadir') as hadir"),
            DB::raw("SUM(status_kehadiran='izin') as izin"),
            DB::raw("SUM(status_kehadiran='sakit') as sakit"),
            DB::raw("SUM(status_kehadiran='alpa') as alpa")
        )
        ->with('peserta')
        ->where('is_final', 1)
        ->whereHas('peserta.hasilPendaftaran', function ($q) {
            $q->where('status', 'diterima');
        });

        // Filter bulan
        if ($this->bulan) {
            $query->whereMonth('tanggal_presensi', $this->bulan);
        }

        // Filter tanggal
        if ($this->tanggal) {
            $query->whereDate('tanggal_presensi', $this->tanggal);
        }

        // Filter nama
        if ($this->nama) {
            $query->whereHas('peserta', function ($q) {
                $q->where('nama', 'like', '%' . $this->nama . '%');
            });
        }

        $data = $query->groupBy('id_peserta')->get();

        return $data->map(function ($item) {
            return [
                'NISN/NIM' => $item->peserta->nisn_nim ?? '-',
                'Nama'     => $item->peserta->nama ?? '-',
                'Hadir'    => $item->hadir,
                'Izin'     => $item->izin,
                'Sakit'    => $item->sakit,
                'Alpa'     => $item->alpa,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NISN/NIM',
            'Nama Peserta',
            'Hadir',
            'Izin',
            'Sakit',
            'Alpa',
        ];
    }

    public function startCell(): string
{
    return 'A3';
}

    // Lebar kolom
    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 30,
            'C' => 10,
            'D' => 10,
            'E' => 10,
            'F' => 10,
        ];
    }

    // Style header
    public function styles(Worksheet $sheet)
{
    return [
        3 => [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '1F4E78',
                ],
            ],
        ],
    ];
}

    // Style keseluruhan sheet
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                // Judul laporan
$event->sheet->mergeCells('A1:F1');
$event->sheet->setCellValue('A1', 'REKAP PRESENSI KESELURUHAN');

$event->sheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 16,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
]);

                $lastRow = $event->sheet->getHighestRow();

                // Border semua data
                $event->sheet->getStyle("A1:F{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    );

                // Alignment tengah
                $event->sheet->getStyle("A1:F{$lastRow}")
                    ->getAlignment()
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                // Kolom angka di tengah
                $event->sheet->getStyle("C2:F{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                // Freeze header
                $event->sheet->freezePane('A2');
            },
        ];
    }
}
