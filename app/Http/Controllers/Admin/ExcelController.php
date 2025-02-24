<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Str;

class ExcelController extends Controller
{
    public function import(Request $request)
    {

        $request->validate([
            'product_excel' => 'required|mimes:xlsx,xls'
        ]);
    
        $file = $request->file('product_excel')->getRealPath();
        $spreadsheet = IOFactory::load($file);
        $productSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        // Skip header row
        array_shift($productSheet);
    
        try {
            foreach ($productSheet as $row) {

                if (empty($row['A']) || empty($row['B']) || empty($row['D'])) {
                    throw new \Exception('Missing required fields in row');
                }
    
                $category = Category::firstOrCreate(
                    ['name' => $row['A']],
                    [
                        'slug' => Str::slug($row['A']),
                        'status' => 1,
                        'show_on_navbar' => 0,
                        'description' => '.'
                    ]
                );
    
                $subCategory = SubCategory::firstOrCreate(
                    [
                        'name' => $row['B'],
                    ],
                    [
                        'slug' => Str::slug($row['B']),
                        'status' => 1,
                        'show_on_navbar' => 0,
                        'description' => '.'
                    ]
                );
    
                // // Validate and parse the date
                $craftedDate = null;
                if (!empty($row['I'])) {
                    try {
                        $craftedDate = Carbon::parse($row['I']);
                    } catch (\Exception $e) {
                        Log::warning("Invalid date format in row: " . json_encode($row));
                        $craftedDate = now();
                    }
                }
    
                // Create product with proper validation and type casting
                Product::create([
                    'category_id' => 1,
                    'sub_category_id' => 2,
                    'name' => trim($row['C']),
                    'sku' => trim($row['D']),
                    'slug' => Str::slug($row['E']),
                    'price' => $row['F'],
                    'selling_price' => $row['G'],
                    'status' => filter_var($row['H'], FILTER_VALIDATE_BOOLEAN),
                    'crafted_date' => $craftedDate,
                    'short_description' => $row['J'],
                    'additional_description' => $row['K'],
                    'description' => $row['L'],
                ]);
            }
    
    
            return response()->json([
                'status' => 'success',
                'message' => 'Products imported successfully'
            ]);
    
        } catch (\Exception $e) {
            Log::error('Product import error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to import products: ' . $e->getMessage()
            ], 500);
        }
    }



    public function export()
    {


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Product Data');

        // Add headers for products table
        $sheet->setCellValue('A1', 'category');
        $sheet->setCellValue('B1', 'sub_category');
        $sheet->setCellValue('C1', 'name');
        $sheet->setCellValue('D1', 'sku');
        $sheet->setCellValue('E1', 'slug');
        $sheet->setCellValue('F1', 'price');
        $sheet->setCellValue('G1', 'selling_price');
        $sheet->setCellValue('H1', 'status');
        $sheet->setCellValue('I1', 'crafted_date');
        $sheet->setCellValue('J1', 'short_description');
        $sheet->setCellValue('K1', 'addtional_description');
        $sheet->setCellValue('L1', 'description');

        $filePath = storage_path('app/public/test.xlsx');

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath);
    }
}
