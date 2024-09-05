<?php

namespace App\Helpers;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

class Spout
{
    /**
     * Export the given tables to an Excel file, using the specified columns
     *
     * @param  mixed  $tables
     * @param  array  $columns
     * @return \Illuminate\Http\Response
     */
    public static function exportExcel($tables, $file_name, array $columns)
    {
        // Create a writer for Excel (.xlsx) files
        $writer = WriterEntityFactory::createXLSXWriter();

        // Save the output to memory (no need to write to a file)
        $temporaryFile = tempnam(sys_get_temp_dir(), "$file_name.xlsx");
        $writer->openToFile($temporaryFile);

        // Create header row
        // Create header row
        $headerRow = WriterEntityFactory::createRowFromArray(array_map(function ($columns) {
            return WriterEntityFactory::createCell($columns);
        }, $columns));
        $writer->addRow($headerRow);

        $columns = array_map('strtolower', $columns);

        // Write data rows
        foreach ($tables as $table) {
            $data = [];

            foreach ($columns as $column)
                $data = WriterEntityFactory::createCell($table->column ?: '');

            $row = WriterEntityFactory::createRowFromArray($data);
            $writer->addRow($row);
        }

        // Close the writer
        $writer->close();

        // Return the file as a download response
        return response()->download($temporaryFile, "$file_name.xlsx")->deleteFileAfterSend(true);
    }
}
