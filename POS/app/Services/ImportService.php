<?php

namespace App\Services;

use App\Helpers\Excel;
use App\Helpers\ImageHelper;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportService
{
    public function importSample($name, array $informationHeaders, array $informations, array $samples)
    {
        // Set headers
        $headers = array_column($informations, 0);

        $columns = [];
        foreach ($headers as $value) {
            $columns[] = strtolower(str_replace(' ', '_', $value));
        }

        $colNumbers = array_flip($columns);

        // Create new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($name);

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

        $data = [];
        // Write sample data rows
        foreach ($samples as $sample) {
            // Get temp data
            $tempData = [];
            foreach ($sample as $key => $value) {
                $tempData[$colNumbers[$key]] = $value;
            }

            // Data is sorting tempData by columns
            $sortedData = [];
            for ($i = 0; $i < count($headers); $i++) {
                $sortedData[] = $tempData[$i] ?? '';
            }
            $data[] = $sortedData;
        }

        // Write data (start from 2nd row)
        Excel::writeData($sheet, $data, 2);

        // Create new Sheet
        $newSheet = new Worksheet($spreadsheet, 'Information');
        $spreadsheet->addSheet($newSheet);

        //Add Informations on 1st Row
        $newSheet->setCellValue('B1', 'THIS SHEET ONLY USED FOR INFORMATIONS, only 1st Sheet will be executed');
        // Add Headers on 3rd Row
        Excel::writeOneRowData($newSheet, $informationHeaders, 3);
        // Add information start from 4th Row
        Excel::writeData($newSheet, $informations, 4);

        return Excel::createAndDownloadExcel($spreadsheet, $name);
    }
    public function importExcel($file, $model, array $mutators)
    {
        if (!file_exists($file)) {
            throw new \Exception("The imported Excel file does not exist.");
        }

        // Load the uploaded file
        $spreadsheet = IOFactory::load($file->getPathname());

        // Access the first worksheet
        $sheet = $spreadsheet->getActiveSheet();

        // Get data
        $rawData = $sheet->toArray();

        // Get headers and remove 1st row from array $rawData
        $headers = array_shift($rawData);

        $headers = $this->columnsMutator($headers, $mutators);

        // Find the index of the image column
        foreach ($headers as $key => $header) {
            if ($header == 'image') {
                $image = $key;
                break;
            }
        }

        // Check if the rawData has the correct number of columns
        if (empty($headers) || count($headers) !== count($rawData[0])) {
            throw new \Exception("The imported Excel file does not have the correct headers.");
        }

        $rowId = 1;
        // Check Null values and save images
        foreach ($rawData as $data) {
            $rowId++;

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
            // Create or update the model with the mapped data
            $model::create($mappedData);
        }
    }

    protected function columnsMutator(array $columnNames, array $mutators): array
    {
        $headers = [];
        foreach ($columnNames as $names) {
            if (array_key_exists($names, $mutators))
                $headers[] = $mutators[$names];
        }
        return $headers;
    }
}
