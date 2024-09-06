<?php

namespace App\Helpers;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Spout
{
    /**
     * Export the given tables to an Excel file, using the specified columns
     *
     * @param  mixed  $tables
     * @param  string  $fileName
     * @param  array  $columns
     * @return \Illuminate\Http\Response
     */
    public static function exportExcel($tables, array $columns)
    {
        // get table name
        $tableName = $tables->first()->getTable();

        // get proper column names
        $colNames = array_keys($columns);
        foreach ($colNames as $key => $colName) {
            $properColumns[$key] = ucwords(str_replace('_', ' ', $colName));
        }

        // Create a writer for Excel (.xlsx) files
        $writer = WriterEntityFactory::createXLSXWriter();

        // Save the output to memory (no need to write to a file)
        $temporaryFile = tempnam(sys_get_temp_dir(), "$tableName.xlsx");
        $writer->openToFile($temporaryFile);

        // Rename the first sheet
        $writer->getCurrentSheet()->setName($tableName);

        // Write header row
        $writer->addRow(WriterEntityFactory::createRowFromArray($properColumns));

        // Write data rows
        foreach ($tables->toArray() as $data) {
            $writer->addRow(WriterEntityFactory::createRowFromArray($data));
        }

        // Create & Rename the second sheet
        $writer->addNewSheetAndMakeItCurrent();
        $writer->getCurrentSheet()->setName('informations');

        // Write Information row
        $writer->addRow(WriterEntityFactory::createRowFromArray(['', 'THIS SHEET ONLY USED FOR INFORMATIONS, only 1st Sheet will be executed']));
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));
        // Write header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Column', 'Nullable', 'Information']);
        $writer->addRow($headerRow);

        $i = 0;
        //Write data rows
        foreach ($columns as $column) {
            $info = [];
            $info[] = $properColumns[$i];
            foreach ($column as $col) {
                $info[] = $col;
            }

            $row = WriterEntityFactory::createRowFromArray($info);
            $writer->addRow($row);
            $i++;
        }

        // Close the writer
        $writer->close();
        // Return the file as a download response
        return response()->download($temporaryFile, "$tableName.xlsx")->deleteFileAfterSend(true);
    }

    /**
     * Import the given Excel file into the given model using the specified column mutators
     *
     * @param  mixed  $file
     * @param  mixed  $model
     * @param  array  $mutators
     *
     * @throws \Exception
     */
    public static function importExcel($file, $model, array $mutators)
    {
        if (!file_exists($file)) {
            throw new \Exception("The imported Excel file does not exist.");
        }

        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($file);

        foreach ($reader->getSheetIterator() as $sheet) {
            if ($sheet->getIndex() > 0)
                break;

            $isHeader = true;
            $rowId = 0;
            foreach ($sheet->getRowIterator() as $row) {
                $data = $row->toArray();
                $rowId++;

                if ($isHeader) {
                    $headers = self::columnsMutator($data, $mutators);

                    // Find the index of the image column
                    foreach ($headers as $key => $header) {
                        if ($header == 'image') {
                            $image = $key;
                            break;
                        }
                    }

                    $isHeader = false;
                    continue;
                }

                // Check if the data has the correct number of columns
                if (empty($headers) || count($headers) !== count($data)) {
                    throw new \Exception("The imported Excel file does not have the correct headers.");
                }

                foreach ($data as $key => $value) {
                    if ($value == '')
                        $data[$key] = null;
                    else if ($key == $image) {
                        if (file_exists($value)) {
                            $fileImage = new UploadedFile($value, basename($value));
                            $data[$key] = ImageHelper::saveImage($fileImage, 'images/product-images');
                        } else
                            throw new \Exception("The Image field on row $rowId does not have correct image path.");
                    }
                }

                // Map the data to the columns using the header names
                $mappedData = array_combine($headers, $data);

                // Filter out any data that doesn't match the expected columns
                // $mappedData = array_intersect_key($mappedData, $model->getFillable());

                // Create or update the model with the mapped data
                $model::create($mappedData);
            }
        }
        $reader->close();
    }

    /**
     * Generate a sample Excel file for importing data
     *
     * @param string $name The name of the sample file
     * @param array $columns The columns of the sample file
     * @param array $samples The sample data
     * @return \Illuminate\Http\Response
     */
    public static function importSample($name, array $columns, array $samples)
    {
        // get proper column names
        $colNames = array_keys($columns);
        $colNumbers = array_flip($colNames);
        $properColumns = [];

        foreach ($colNames as $key => $colName) {
            $properColumns[$key] = ucwords(str_replace('_', ' ', $colName));
        }

        // Create a writer for Excel (.xlsx) files
        $writer = WriterEntityFactory::createXLSXWriter();

        // Save the output to memory (no need to write to a file)
        $temporaryFile = tempnam(sys_get_temp_dir(), "$name.xlsx");
        $writer->openToFile($temporaryFile);

        // Rename the first sheet
        $writer->getCurrentSheet()->setName($name);
        $writer->addRow(WriterEntityFactory::createRowFromArray(['test', 'test2']));
        // Write header row
        $writer->addRow(WriterEntityFactory::createRowFromArray($properColumns));

        // Write sample data rows
        foreach ($samples as $sample) {
            // Get temp data
            $tempData = [];
            foreach ($sample as $key => $value) {
                $tempData[$colNumbers[$key]] = $value;
            }

            // Data is sorting tempData by columns
            $data = [];
            for ($i = 0; $i < count($colNames); $i++) {
                $data[] = $tempData[$i] ?? '';
            }

            // Write row
            $writer->addRow(WriterEntityFactory::createRowFromArray($data));
        }

        // Create & Rename the second sheet
        $writer->addNewSheetAndMakeItCurrent();
        $writer->getCurrentSheet()->setName('informations');

        // Write Information row
        $writer->addRow(WriterEntityFactory::createRowFromArray(['', 'THIS SHEET ONLY USED FOR INFORMATIONS, only 1st Sheet will be executed']));
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));
        // Write header row
        $writer->addRow(WriterEntityFactory::createRowFromArray(['Column', 'Nullable', 'Information']));

        $i = 0;
        //Write data rows
        foreach ($columns as $column) {
            $info = [];
            $info[] = $properColumns[$i];
            foreach ($column as $col) {
                $info[] = $col;
            }

            $row = WriterEntityFactory::createRowFromArray($info);
            $writer->addRow($row);
            $i++;
        }

        // Close the writer
        $writer->close();
        // Return the file as a download response
        return response()->download($temporaryFile, "$name.xlsx")->deleteFileAfterSend(true);
    }

    public static function test()
    {

        // Create a writer for Excel (.xlsx) files
        $writer = WriterEntityFactory::createXLSXWriter();

        // Save the output to memory (no need to write to a file)
        $temporaryFile = tempnam(sys_get_temp_dir(), "name.xlsx");
        $writer->openToFile($temporaryFile);

        // Rename the first sheet
        $writer->getCurrentSheet()->setName('name');

        // Write header row
        $writer->addRow(WriterEntityFactory::createRowFromArray(['test', 'test2']));

        // Create & Rename the second sheet
        $writer->addNewSheetAndMakeItCurrent();
        $writer->getCurrentSheet()->setName('informations');

        // Write Information row
        $writer->addRow(WriterEntityFactory::createRowFromArray(['', 'THIS SHEET ONLY USED FOR INFORMATIONS, only 1st Sheet will be executed']));
        $writer->addRow(WriterEntityFactory::createRowFromArray([]));
        // Write header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Column', 'Nullable', 'Information']);
        $writer->addRow($headerRow);

        // Close the writer
        $writer->close();
        // Return the file as a download response
        return response()->download($temporaryFile, "name.xlsx")->deleteFileAfterSend(true);
    }

    protected static function columnsMutator(array $columnNames, array $mutators): array
    {
        $headers = [];
        foreach ($columnNames as $names) {
            if (array_key_exists($names, $mutators))
                $headers[] = $mutators[$names];
        }
        return $headers;
    }
}
