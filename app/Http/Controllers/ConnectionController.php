<?php

namespace App\Http\Controllers;

use App\Connection;
use App\User;
use App\Video;
use Auth0\Login\Facade\Auth0;
use Illuminate\Http\Request;

class ConnectionController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInfo = Auth0::jwtUser();

        $user = null;
        if ($userInfo !== null) {
            $user = User::where('sub_auth0', $userInfo->sub)->first();
        }

        $connection = null;
        if ($user !== null) {
            $connection = Connection::where('user_id', $user->id)->first();
        }
        if ($connection === null) {
            $connection = new Connection();
            $connection->code = $this->randomCode();
            $connection->action_code = $request->action_code;
            $connection->user()->associate($user);
        }
        $connection->action_code = $request->action_code;
        if (
            $request->action === 'individualPurchase' ||
            $request->action === 'companyPurchase' ||
            $request->action === 'videoRecommendation'
        ) $connection->video()->associate(Video::find($request->video_id));
        $connection->save();

        return response()->json([
            'code' => $connection->code
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $connection = Connection::where('code', $code)->get()->last();
        if ($connection->action_code === 'auth') {
            return view('auth');
        }
        else if ($connection->action_code === 'individualPurchase') {
            return view('individualPurchase');
        }
        else if ($connection->action_code === 'companyPurchase') {
            return view('companyPurchase');
        }
        else if ($connection->action_code === 'videoRecommendation') {
            return view('videoRecommendation');
        }
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

    public function randomCode() {

        $id = strtolower(str_random(4));

        $validator = \Validator::make(['id'=>$id],['id'=>'unique:connections,code']);

        if ($validator->fails()) {
            return $this->randomCode();
        }

        return $id;
    }
}
