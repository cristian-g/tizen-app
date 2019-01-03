<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::with('users')->orderBy('created_at', 'asc')->get();
        return response()->json(['videos'=> $videos->toArray()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);
        return response()->json(VideoController::getVideoJson($video), 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $id)
    {
        Video::find($id)->increment('views', 1);
        return response()->json(null, 200);
    }

    public function completeView(Request $request, $id)
    {
        Video::find($id)->increment('views', 1);
        return response()->json(null, 200);
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

    public static function getVideoJson($video)
    {
        return [
            "description" => $video->description,
            "id" => $video->id,
            "name" => $video->name,
            "author" => $video->author,
            "date" => $video->date,
            "duration" => $video->duration,
            "source" => $video->source,
            "photo_urls" => [
                "size" => $video->photo_urls_size,
                "url" => $video->photo_urls_url,
            ],
            "color" => $video->color,
            "price" => $video->price,
            "business_price" => $video->business_price,
            "views" => $video->views,
            "purchases" => $video->purchases,
        ];
    }
}
