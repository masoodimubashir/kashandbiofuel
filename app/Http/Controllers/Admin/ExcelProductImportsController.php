<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelProductImportsController extends Controller
{
    public function __invoke(Request $request)
    {


        try {

            $validator = Validator::make($request->all(), [
                'product_excel' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The file must be a file of type: xlsx, xls, csv.'
                ], 422);
            }


             Excel::import(new ProductsImport, $request->product_excel);

            return response()->json([
                'status' => 'success',
                'message' => 'Products Imported Successfully'
            ]);

        } catch (\Throwable $th) {
            
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
