<?php

namespace App\Http\Controllers\Admin;

use App\Enum\BannerPosition;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use Validator;

class BannerController extends Controller
{


    // Return existing images
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $files = [];
            foreach (BannerPosition::cases() as $banner) {
                $filename = strtolower($banner->value) . '-banner.jpg';
                $bannerModel = Banner::where('position', $banner->value)->first();

                if (Storage::disk('public')->exists('Banners/' . $filename)) {
                    $files[] = [
                        'id' => $banner->value,
                        'url' => asset('storage/Banners/' . $filename),
                        'link' => $bannerModel ? $bannerModel->link : ''
                    ];
                }
            }

            return response()->json([
                'files' => $files
            ]);
        }

        return view('layouts.dashboard.Banner.banners');
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('file')) {
            $position = BannerPosition::from($request->position)->value;
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = $position . '-banner.' . $extension;
            $path = $request->file('file')->storeAs('Banners', $filename, 'public');

            $banner = Banner::updateOrCreate(
                ['position' => $position],
                [
                    'image_path' => $path,
                    'link' => $request->link
                ]
            );

            return response()->json([
                'id' => $banner->id,
                'success' => true
            ]);
        }
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('file')) {

            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = $banner->position . '-banner.' . $extension;
            $path = $request->file('file')->storeAs('Banners', $filename, 'public');

            $banner->image_path = $path;
        }

        // Update link if provided
        if ($request->has('link')) {
            $banner->link = $request->link;
        }

        $banner->save();

        return response()->json([
            'id' => $banner->id,
            'success' => true,
            'message' => 'Banner updated successfully'
        ]);
    }


    // public function updateLinks(Request $request, $id)
    // {


    //     if ($request->ajax()) {

    //         try {
    //             $validate =  Validator::make($request->all(), [
    //                 'link' => 'required|url',
    //             ]);

    //             if ($validate->fails()) {

    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => $validate->errors()->first()
    //                 ]);
    //             }

    //             $banner = Banner::findOrFail($id);

    //             if (!$banner) {
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Please Upload The Banner First'
    //                 ], Response::HTTP_NOT_FOUND);
    //             }

    //             $banner->link = $request->link;
    //             $banner->save();

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Link Updated Successfully'
    //             ]);
    //         } catch (Exception $e) {

    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Something Went Wrong'
    //             ]);
    //         }
    //     }
    // }
}
