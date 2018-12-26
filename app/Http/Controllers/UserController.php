<?php

namespace App\Http\Controllers;

use App\User;
use Auth0\Login\Facade\Auth0;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $user = new User([
            'name' => $userInfo->given_name . " " . $userInfo->family_name,
            'sub_auth0' => $userInfo->sub,
            'picture' => $userInfo->picture,
        ]);
        try {
            $user->save();
            return response()->json([
                'user' => $user
            ], 200);
        }
        catch (QueryException $exception) {
            // User already exists
            $existingUser = User::where('sub_auth0', $userInfo->sub)->first();
            return response()->json([
                'user' => $existingUser
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        return response()->json([
            'user' => $user
        ], 200);
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
        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();
        $user->picture = $request->url;
        $user->save();
        return response()->json([
            'user' => $user
        ], 200);
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
