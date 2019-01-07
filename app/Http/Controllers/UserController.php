<?php

namespace App\Http\Controllers;

use App\Connection;
use App\Department;
use App\User;
use Auth0\Login\Facade\Auth0;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $json = [];

        // Get user info (logged)
        $userInfo = Auth0::jwtUser();
        $user = User::where('sub_auth0', $userInfo->sub) -> first();

        // Frequent contacts
        $frequentUsers = DB::table('users')
            ->select(['users.*', DB::raw('COUNT(recommendations.id) as recommendations_count'), DB::raw('MAX(recommendations.created_at) as last_send')])
            ->join('recommendations', 'recommendations.target_user_id', '=', 'users.id')
            ->where('recommendations.origin_user_id', '=', $user->id)
            ->groupBy('recommendations.target_user_id')
            //->orderBy('recommendations_count', 'desc')
            ->orderBy('last_send', 'desc')
            ->limit(6)
            ->get();
        $frequentUsersJson = [];
        foreach ($frequentUsers as $contact) {
            array_push($frequentUsersJson, self::getContactJson($contact, $user));
        }

        $frequentContactsJson = [
            'frequent_contacts' => $frequentUsersJson
        ];
        array_push($json, $frequentContactsJson);

        $departments = Department::orderBy('order', 'asc')->get();
        $departmentsArray = [];
        foreach ($departments as $department) {
            $contactsJson = [];
            foreach ($department->users()->get() as $contact) {
                array_push($contactsJson, self::getContactJson($contact, $user));
            }
            $department["users"] = $contactsJson;
            array_push($json, $department);
        }
        //array_push($json, $departmentsArray);

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
        $userInfo = Auth0::jwtUser();
        $user = new User([
            'name' => $userInfo->given_name . " " . $userInfo->family_name,
            'sub_auth0' => $userInfo->sub,
            'picture' => $userInfo->picture,
        ]);
        try {
            $user->save();

            // Update connection
            $connection = Connection::where('code', $request->code)->first();
            $connection->user()->associate($user);
            $connection->save();

            return response()->json([
                'user' => $user
            ], 200);
        }
        catch (QueryException $exception) {
            // User already exists
            $existingUser = User::where('sub_auth0', $userInfo->sub)->first();

            // Update connection
            $connection = Connection::where('code', $request->code)->first();
            $connection->user()->associate($existingUser);
            $connection->save();

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
    public function show()
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

    public static function getContactJson($contact, $user = null)
    {
        $json = [
            "description" => null,
            "id" => $contact->sub_auth0,
            "name" => $contact->name,
            "author" => null,
            "date" => null,
            "duration" => null,
            "source" => null,
            "photo_urls" => [
                "size" => null,
                "url" => $contact->picture,
            ],
            "color" => null,
            "price" => null,
            "business_price" => null,
            "views" => null,
            "purchases" => null,
            "category" => null,
        ];
        if ($user != null) {
            $json["purchased"] = null;
        }
        if ($user != null) {
            $json["resume"] = null;
            $json["timeToResume"] = null;
        }
        return $json;
    }
}
