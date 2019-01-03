<?php

namespace App\Http\Controllers;

use App\Category;
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

    public function home()
    {
        $json = [];

        // Get user info (if logged)
        $userInfo = Auth0::jwtUser();
        $user = null;
        if ($userInfo !== null) {
            $user = User::where('sub_auth0', $userInfo->sub)->first();
        }

        // Continue watching
        if ($user !== null) {
            $continueWatchingVideosJson = [];
            $pendingViews = $user->views()->with('video')->where(['completed' => false])->get();
            foreach ($pendingViews as $view) {
                $video = $view->video()->first();
                array_push($continueWatchingVideosJson, self::getVideoJson($video));
            }
            $continueWatchingJson = [
                'continue_watching' => $continueWatchingVideosJson
            ];
            array_push($json, $continueWatchingJson);
        }

        // Recommended for you
        /*if ($user !== null) {
            $categories = Category::withCount([
                'views as views_count' => function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            ])->get();
            $categoriesArray = [];
            foreach ($categories as $category) {
                array_push($categoriesArray, Category::getCategoryJson($category));
            }
            array_push($json, $categoriesArray);
        }*/

        /*if ($user !== null) {
            $recommendedVideosJson = [];
            $pendingViews = $user->views()->with('video')->where(['completed' => false])->get();
            foreach ($pendingViews as $view) {
                $video = $view->video()->first();
                array_push($recommendedVideosJson, self::getVideoJson($video));
            }
            $recommendedJson = [
                'continue_watching' => $recommendedVideosJson
            ];
            array_push($json, $recommendedJson);
        }*/

        // New
        $newVideosJson = [];
        $newVideos = Video::orderBy('date', 'desc')
            ->limit(7)->get();
        foreach ($newVideos as $video) {
            array_push($newVideosJson, self::getVideoJson($video));
        }
        $newJson = [
            'new' => $newVideosJson
        ];
        array_push($json, $newJson);

        // Most viewed
        $mostViewedVideosJson = [];
        $mostViewedVideos = Video::orderBy('views', 'desc')->limit(7)->get();
        foreach ($mostViewedVideos as $video) {
            array_push($mostViewedVideosJson, self::getVideoJson($video));
        }
        $mostViewedJson = [
            'most_viewed' => $mostViewedVideosJson
        ];
        array_push($json, $newJson);

        return response()->json($json, 200);
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
