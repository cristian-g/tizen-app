<?php

namespace App\Http\Controllers;

use App\Recommendation;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Auth0\Login\Facade\Auth0;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();

        $recommendations = Recommendation::where(['target_user_id' => $user->id])/*->with(['originUser', 'video'])*/->orderBy('created_at', 'desc')->get();
        $recommendationsArray = [];
        foreach ($recommendations as $recommendation) {
            $video = $recommendation->video()->first();
            $originUser = $recommendation->originUser()->first();
            $recommendation["video"] = VideoController::getVideoJson($video, $user);
            $recommendation["origin_user"] = UserController::getContactJson($originUser, $user);
            array_push($recommendationsArray, $recommendation);
        }
        return response()->json(['notifications'=> $recommendationsArray], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = Video::find($request->video_id);

        $recommendation = new \App\Recommendation();

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $recommendation->originUser()->associate($user);

        $recommendation->video()->associate($video);

        $targetUser = User::where('sub_auth0', $request->user_id) -> first();
        $recommendation->targetUser()->associate($targetUser);

        $recommendation->save();

        return response()->json(null, 200);
    }

    public function storeExample(Request $request)
    {
        $video = Video::find('tech_3');

        $recommendation = new \App\Recommendation();

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $recommendation->targetUser()->associate($user);

        $recommendation->video()->associate($video);

        $targetUser = User::where('sub_auth0', 'ernesto-sevilla') -> first();
        $recommendation->originUser()->associate($targetUser);

        $recommendation->save();

        return response()->json(null, 200);
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
    public function edit($id)
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
