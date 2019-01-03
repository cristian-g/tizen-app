<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('videos')->orderBy('order', 'asc')->get();
        $categoriesArray = [];
        foreach ($categories as $category) {
            array_push($categoriesArray, $this->getCategoryJson($category));
        }
        return response()->json(['categories'=> $categoriesArray], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $json = $this->getCategoryJson($category);
        return response()->json(['videos' => $json["videos"]], 200);
    }

    private function getCategoryJson($category)
    {
        $videosArray = [];
        foreach ($category->videos()->get() as $video) {
            array_push($videosArray, VideoController::getVideoJson($video));
        }
        return [
            "key" => $category->id,
            "title" => $category->title,
            "videos" => $videosArray
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
