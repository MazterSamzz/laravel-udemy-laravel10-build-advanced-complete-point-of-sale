<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Helpers\Excel;

class ExportService
{
    /**
     * Export the given tables to an Excel file, using the specified columns
     *
     * @param  mixed  $tables
     * @param  array  $informations
     * @return \Illuminate\Http\Response
     */
    public function toExcel($tables, array $informationHeaders, array $informations)
    {
        // Set tablename
        $tablename = $tables->first()->getTable();
        // Set headers
        $headers = array_column($informations, 0);

        // Create new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($tablename);

        // Auto size Headers
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
            $col++;
        }

        // Set Max Column
        $colmax = 'A';
        for ($i = 1; $i < count($headers); $i++) {
            $colmax++;
        }

        // Styling Headers
        $sheet->getStyle("A1:" . $colmax . "1")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '000000', // Background black
                ],
            ],
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => 'FFFFFF'], // Font white
            ],
        ]);

        // Write Headers (at 1st row)
        Excel::writeOneRowData($sheet, $headers, 1);
        // Write data (start from 2nd row)
        Excel::writeData($sheet, $tables->toArray(), 2);

        // Create new Sheet
        $newSheet = new Worksheet($spreadsheet, 'Information');
        $spreadsheet->addSheet($newSheet);

        //Add Informations on 1st Row
        $newSheet->setCellValue('B1', 'THIS SHEET ONLY USED FOR INFORMATIONS, only 1st Sheet will be executed');
        // Add Headers on 3rd Row
        Excel::writeOneRowData($sheet, $informationHeaders, 3);
        // Add information start from 4th Row
        Excel::writeData($newSheet, $informations, 4);

        return Excel::createAndDownloadExcel($spreadsheet, $tablename);
    }
}
