<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\User;
use App\Video;
use Auth0\Login\Facade\Auth0;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $video->increment('purchases', 1);

        $purchase = new \App\Purchase();

        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $purchase->user()->associate($user);

        $purchase->video()->associate($video);

        $purchase->stripe_token = $request->stripe_token;

        try {
            $purchase->save();
        }
        catch (QueryException $exception) {
            $purchase = Purchase::where([
                "user_id" => $user->id,
                "video_id" => $video->id,
            ])->first();
            $purchase->update([
                "stripe_token" => $request->stripe_token
            ]);
        }

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
