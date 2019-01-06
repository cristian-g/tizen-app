<?php

namespace App\Http\Controllers;

use App\Category;
use App\Purchase;
use App\User;
use App\Video;
use App\View;
use Auth0\Login\Facade\Auth0;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $recommended_videos = 6.0;
        if ($user !== null) {
            $categories = DB::table('categories')
                ->select(['categories.*', DB::raw('COUNT(views.id) as views'), DB::raw('MAX(views.created_at) as last_view')])
                ->where('views.user_id', '=', $user->id)
                ->join('videos', 'categories.id', '=', 'videos.category_id')
                ->join('views', 'videos.id', '=', 'views.video_id')
                ->groupBy('categories.id')
                ->orderBy('last_view', 'desc')
                ->get();

            $totalViews = 0;
            foreach ($categories as $category) {
                $totalViews += $category->views;
            }
            foreach ($categories as $category) {
                $category->normalized_views = floor(($category->views / $totalViews) * $recommended_videos);
            }

            $current = 0;
            foreach ($categories as $category) {
                $current += $category->normalized_views;
            }
            $difference = $recommended_videos - $current;

            if (count($categories) > 0) {
                $categories[0]->normalized_views += $difference;
            }

            $recommendedVideosArray = [];
            foreach ($categories as $category) {
                $videos = Video::where(['category_id' => $category->id])->with('views')->get()->sortBy(function($video) use ($user)
                {
                    $count = $video->views()->where(['views.user_id' => $user->id])->count();
                    return $count;
                });
                $count_category = 0;
                foreach ($videos as $index => $video) {
                    if ($count_category >= $category->normalized_views) break;
                    array_push($recommendedVideosArray, $video);
                    $count_category++;
                }
            }

            $recommendedJson = [
                'recommended_for_you' => $recommendedVideosArray
            ];
            array_push($json, $recommendedJson);
        }

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
        array_push($json, $mostViewedJson);

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

        $userInfo = Auth0::jwtUser();

        $user = null;
        if ($userInfo !== null) {
            $user = User::where('sub_auth0', $userInfo->sub)->first();
        }

        return response()->json(VideoController::getVideoJson($video, $user), 200);
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
        $view = new \App\View();

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $view->user()->associate($user);

        $video = Video::find($id);
        $view->video()->associate($video);

        $view->time_to_resume = $request->time_to_resume;

        try {
            $view->save();
        }
        catch (QueryException $exception) {
            $view = View::where([
                "user_id" => $user->id,
                "video_id" => $video->id,
            ])->first();
            $view->update([
                "completed" => false,
                "time_to_resume" => $request->time_to_resume
            ]);
        }

        return response()->json(null, 200);
    }

    public function complete(Request $request, $id)
    {
        Video::find($id)->increment('views', 1);

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();

        $video = Video::find($id);

        $view = View::where([
            "user_id" => $user->id,
            "video_id" => $video->id,
        ])->first();

        if ($view != null) {
            $view->update([
                "completed" => true
            ]);
        }
        else {
            $view = new \App\View();
            $view->user()->associate($user);
            $view->video()->associate($video);
            $view->completed = true;
            $view->save();
        }

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

    public static function getVideoJson($video, $user = null)
    {
        $json = [
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
            "category" => CategoryController::getCategoryJson($video->category)
        ];
        if ($user != null) {
            $purchase = Purchase::where([
                "user_id" => $user->id,
                "video_id" => $video->id,
            ])->first();
            $json["purchased"] = $purchase != null;
        }
        if ($user != null) {
            $view = View::where([
                "user_id" => $user->id,
                "video_id" => $video->id,
            ])->first();
            $json["resume"] = $view != null && (!$view->completed);
            if ($json["resume"]) {
                $json["timeToResume"] = $view->time_to_resume;
            }
        }
        return $json;
    }
}
