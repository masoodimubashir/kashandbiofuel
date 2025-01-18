<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class StatusUpdateController extends Controller
{

    public function updateStatus(Request $request, $id)
    {
        try {


            // Make the modal request dynamically
            $model = $this->makeModalRequest($request->model, $id);

            // Check if the modal was found
            if (!$model) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Modal not found'
                ]);
            }

            // Update the modal's status
            $model->status = $request->status;
            $model->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Model status updated successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update status',
            ], 500);
        }
    }


    public function updateShowOnNavabr(Request $request, $id)
    {
        try {


            $model = $this->makeModalRequest($request->model, $id);

            if (!$model) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Modal not found'
                ]);
            }

            $model->show_on_navbar = $request->show_on_navbar;

            $model->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Model status updated successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update status',
            ], 500);
        }
    }




    private function makeModalRequest($modal, $id)
    {
        switch ($modal) {

            case 'Category':
                return Category::find($id);

            case 'SubCategory':
                return SubCategory::find($id);

            case 'Product':
                return Product::find($id);

            case 'Coupon':
                return Coupon::find($id);

            case 'Product':
                return Product::find($id);
                
            default:
                return null;
        }
    }
}
