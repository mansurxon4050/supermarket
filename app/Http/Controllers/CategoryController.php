<?php

namespace App\Http\Controllers;

use App\Http\Resources\BannerResource;
use App\Http\Resources\CategoryResource;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
            $category=Category::all();

        return CategoryResource::collection($category);

    } public function banner_index()
    {
            $banner=Banner::all();

        return BannerResource::collection($banner);

    }
    public function banner_delete(Request $request)
    {
        Banner::find($request->id)->delete();
        return response()->json(['success' => true]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function banner_add(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);
        $filename = $request->file('image');
        $imagename = "banners/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/banners/', $imagename);
        Banner::create([
            'image' => $imagename,
        ]);
        return response()->json(['success' => true]);

    }
    public function banner_update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'image' => 'required|image',
        ]);
        $banner=Banner::find($request->id);
        $destination = 'storage/banners' . $banner->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $filename = $request->file('image');
        $imagename = "banners/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/banners/', $imagename);
        Banner::find($request->id)->update([
            'image' => $imagename,
        ]);
        return response()->json(['success' => true]);
    }
        public function category_add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);
        $filename = $request->file('image');
        $imagename = "categories/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/categories/', $imagename);
        Category::create([
            'image' => $imagename,
            'name'=>  request('name'),
        ]);
        return response()->json(['success' => true]);

    }
    public function category_update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'image' => 'required|image',
        ]);
        $category=Category::find($request->id);
        $destination = 'storage/' . $category->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $filename = $request->file('image');
        $imagename = "categories/" . $filename->getClientOriginalName();
        $filename->move(public_path() . '/storage/categories/', $imagename);
        Category::find($request->id)->update([
            'image' => $imagename,
            'name'=>  request('name'),
        ]);
        return response()->json(['success' => true]);
    }
        public function category_updateNoImage(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);
        Category::find($request->id)->update([
            'name'=>  request('name'),
        ]);
        return response()->json(['success' => true]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_category(Request $request)
    {
        Category::find($request->id)->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
