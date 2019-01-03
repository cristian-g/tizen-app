<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use App\View;
use Auth0\Login\Facade\Auth0;
use Illuminate\Database\QueryException;
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

    public function view(Request $request, $id)
    {
        Video::find($id)->increment('views', 1);

        $view = new \App\View();

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $view->user()->associate($user);

        $video = Video::find($id);
        $view->video()->associate($video);

        try {
            $view->save();
        }
        catch (QueryException $exception) {
            $view = View::where([
                "user_id" => $user->id,
                "video_id" => $video->id,
            ])->first();
            $view->update([
                "completed" => false
            ]);
        }

        return response()->json(null, 200);
    }

    public function complete(Request $request, $id)
    {
        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();

        $video = Video::find($id);

        $view = View::where([
            "user_id" => $user->id,
            "video_id" => $video->id,
        ])->first();
        $view->update([
            "completed" => true
        ]);

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
