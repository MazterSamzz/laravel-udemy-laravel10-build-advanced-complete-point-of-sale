<?php

namespace App\Helpers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    /**
     * Write one row of data to the given sheet
     *
     * @param Worksheet $sheet
     * @param array $data
     * @return void
     */
    public static function writeOneRowData(Worksheet $sheet, array $data, $row): void
    {
        $col = 'A';
        foreach ($data as $value) {
            $sheet->setCellValue($col . $row, $value);
            $col++;
        }
    }

    /**
     * Write data to the given sheet, at the specified row.
     *
     * @param Worksheet $sheet
     * @param array $data Data to be written
     * @param int $row Start Row for data
     * @return void
     */
    public static function writeData(Worksheet $sheet, array $data, int $row): void
    {
        foreach ($data as $rawData) {
            $col = 'A';
            foreach ($rawData as $value) {
                $sheet->setCellValue($col . $row, $value);
                $col++;
            }
            $row++;
        }
    }

    /**
     * Create an Excel file from the given Spreadsheet and force download it.
     *
     * @param Spreadsheet $spreadsheet The Spreadsheet to be converted to Excel file
     * @param string $filename The filename of the Excel file to be download
     * @return \Illuminate\Http\Response
     */
    public static function createAndDownloadExcel(Spreadsheet $spreadsheet, $filename)
    {
        // Create writer and save file
        $writer = new Xlsx($spreadsheet);
        $temporaryFile = tempnam(sys_get_temp_dir(), $filename) . ".xlsx";
        $writer->save($temporaryFile);

        // Return the file as a download response
        return response()->download($temporaryFile, $filename . '.xlsx')->deleteFileAfterSend(true);
    }
}
