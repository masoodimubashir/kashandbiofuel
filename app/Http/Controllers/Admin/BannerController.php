<?php

namespace App\Http\Controllers\Admin;

use App\Enum\BannerPosition;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{


    // Return existing images
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $bannerPositions = [
                'header' => 'header-banner.jpg',
                'slider' => 'slider-banner.jpg',
                'featured' => 'featured-banner.jpg',
                'promotion' => 'promotion-banner.jpg',
                'footer' => 'footer-banner.jpg'
            ];

            $files = [];



            foreach ($bannerPositions as $position => $filename) {


                if (Storage::disk('public')->exists('Banners/' . $filename)) {


                    $files[] = [
                        'id' => $position,
                        'url' => asset('storage/Banners/' . $filename)
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
        if ($request->hasFile('file')) {


            $position = BannerPosition::from($request->position)->value;

            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = $position . '-banner.' . $extension;
            $path = $request->file('file')->storeAs('Banners', $filename, 'public');

            $banner = Banner::updateOrCreate(
                ['position' => $position],
                ['image_path' => $path]
            );

            return response()->json([
                'id' => $banner->id,
                'success' => true
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = 'banner-header.' . $extension;
            $path = $request->file('file')->storeAs('Banners', $filename, 'public');

            $banner->image_path = $path;
            $banner->save();

            return response()->json([
                'id' => $banner->id,
                'success' => true
            ]);
        }
    }
}
