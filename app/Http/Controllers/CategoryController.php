<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Auth0\Login\Facade\Auth0;
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
        // Get user info (if logged)
        $userInfo = Auth0::jwtUser();
        $user = null;
        if ($userInfo !== null) {
            $user = User::where('sub_auth0', $userInfo->sub)->first();
        }

        $categories = Category::with('videos')->orderBy('order', 'asc')->get();
        $categoriesArray = [];
        foreach ($categories as $category) {
            array_push($categoriesArray, self::getCategoryJsonWithVideos($category, $user));
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
        // Get user info (if logged)
        $userInfo = Auth0::jwtUser();
        $user = null;
        if ($userInfo !== null) {
            $user = User::where('sub_auth0', $userInfo->sub)->first();
        }

        $category = Category::find($id);
        $json = self::getCategoryJsonWithVideos($category, $user);
        return response()->json(['videos' => $json["videos"]], 200);
    }

    public static function getCategoryJson($category)
    {
        return [
            "key" => $category->id,
            "title" => $category->title,
        ];
    }

    public static function getCategoryJsonWithVideos($category, $user = null)
    {
        $videosArray = [];
        foreach ($category->videos()->get() as $video) {
            array_push($videosArray, VideoController::getVideoJson($video, $user));
        }
        return [
            "key" => $category->id,
            "title" => $category->title,
            "videos" => $videosArray,
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
