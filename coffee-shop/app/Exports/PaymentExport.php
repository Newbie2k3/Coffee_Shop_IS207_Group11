<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Payment::where('status', 'paid')->with('user', 'payment_details.product')->get();
    }

    public function headings(): array
    {
        return [
            'Tên Khách Hàng',
            'Email',
            'Hình Thức',
            'Giá Trị Hóa Đơn',
            'Thời Gian',
        ];
    }

    public function map($payment): array
    {
        return [
            'Tên Khách Hàng' => $payment->user->name ?? 'Đã xóa',
            'Email' => $payment->email,
            'Hình Thức Thanh Toán' => $payment->payment_method,
            'Giá Trị Hóa Đơn' => $payment->amount,
            'Thời Gian' => $payment->created_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Heading styles
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'], // White text color
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0F9D58'], // Green background color
            ],
        ]);

        // Column widths
        $sheet->getColumnDimension('A')->setWidth(20);  // Tên Khách Hàng
        $sheet->getColumnDimension('B')->setWidth(20);  // Email
        $sheet->getColumnDimension('C')->setWidth(10);  // Hình Thức Thanh Toán
        $sheet->getColumnDimension('D')->setWidth(15);  // Giá Trị Hóa Đơn
        $sheet->getColumnDimension('E')->setWidth(20);  // Thời Gian
    }
}
