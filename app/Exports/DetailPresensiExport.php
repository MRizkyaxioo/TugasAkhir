<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class DetailPresensiExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $peserta;
    protected $presensiData;

    public function __construct($peserta, $presensiData)
    {
        $this->peserta     = $peserta;
        $this->presensiData = $presensiData;
    }

    public function collection()
    {
        $hariIndonesia = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        return $this->presensiData->map(function ($p) use ($hariIndonesia) {
            $hari    = '-';
            $tanggal = '-';

            if ($p->tanggal_presensi) {
                $hari    = $hariIndonesia[date('l', strtotime($p->tanggal_presensi))] ?? '-';
                $tanggal = date('d-m-Y', strtotime($p->tanggal_presensi));
            }

            $statusMap = [
                'hadir' => 'Hadir',
                'izin'  => 'Izin',
                'sakit' => 'Sakit',
                'alpa'  => 'Alpa',
            ];

            return [
                'hari'    => $hari,
                'tanggal' => $tanggal,
                'status'  => $statusMap[$p->status_kehadiran] ?? ucfirst($p->status_kehadiran),
            ];
        });
    }

    public function headings(): array
    {
        return ['Hari', 'Tanggal', 'Status'];
    }

    public function title(): string
    {
        return 'Rekap Presensi';
    }

    public function styles(Worksheet $sheet)
    {
        // Bold header
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);

        // Background header
        $sheet->getStyle('A1:C1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFF5E6D0');

        // Border semua cell
        $lastRow = $this->presensiData->count() + 1;
        $sheet->getStyle("A1:C{$lastRow}")->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Center kolom Hari dan Status
        $sheet->getStyle("A1:A{$lastRow}")->getAlignment()->setHorizontal('center');
        $sheet->getStyle("C1:C{$lastRow}")->getAlignment()->setHorizontal('center');

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 18,
            'C' => 12,
        ];
    }
}
