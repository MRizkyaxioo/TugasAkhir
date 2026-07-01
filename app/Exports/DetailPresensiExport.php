<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailPresensiExport implements
    FromCollection,
    WithHeadings,
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithCustomStartCell
{
    protected $peserta;
    protected $presensiData;

    public function __construct($peserta, $presensiData)
    {
        $this->peserta = $peserta;
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

            $hari = '-';
            $tanggal = '-';

            if ($p->tanggal_presensi) {
                $hari = $hariIndonesia[date('l', strtotime($p->tanggal_presensi))] ?? '-';
                $tanggal = date('d-m-Y', strtotime($p->tanggal_presensi));
            }

            return [
                $hari,
                $tanggal,
                ucfirst($p->status_kehadiran),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Hari',
            'Tanggal',
            'Status',
        ];
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 18,
            'C' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            7 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
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

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function (AfterSheet $event) {

                // Judul
                $event->sheet->mergeCells('A1:C1');
                $event->sheet->setCellValue('A1', 'DETAIL PRESENSI PESERTA MAGANG');

                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Biodata peserta
                $event->sheet->setCellValue('A3', 'NISN/NIM');
                $event->sheet->setCellValue('B3', ': ' . $this->peserta->nisn_nim);

                $event->sheet->setCellValue('A4', 'Nama Peserta');
                $event->sheet->setCellValue('B4', ': ' . $this->peserta->nama);

                $event->sheet->setCellValue('A5', 'Sekolah/Kampus');
                $event->sheet->setCellValue(
                    'B5',
                    ': ' . ($this->peserta->sekolahKampus->nama_sekolah_kampus ?? '-')
                );

                // Bold label
                $event->sheet->getStyle('A3:A5')->getFont()->setBold(true);

                $lastRow = $event->sheet->getHighestRow();

                // Border tabel saja
                $event->sheet
                    ->getStyle("A7:C{$lastRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    );

                // Tengah
                $event->sheet
                    ->getStyle("A7:C{$lastRow}")
                    ->getAlignment()
                    ->setVertical(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    );

                $event->sheet
                    ->getStyle("A7:C{$lastRow}")
                    ->getAlignment()
                    ->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );

                // Freeze header tabel
                $event->sheet->freezePane('A8');
            }

        ];
    }
}
