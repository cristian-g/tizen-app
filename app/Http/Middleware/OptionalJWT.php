<?php

namespace App\Http\Middleware;

use Closure;
use Auth0\Login\Contract\Auth0UserRepository;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;

class OptionalJWT
{
    protected $userRepository;

    /**
     * CheckJWT constructor.
     *
     * @param Auth0UserRepository $userRepository
     */
    public function __construct(Auth0UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth0 = \App::make('auth0');

        $accessToken = $request->bearerToken();
        //return response()->json(["message" => $accessToken], 401);
        //return response()->json(["message" => "dffddf"], 401);

        if ($accessToken !== null) {
            try {
                $tokenInfo = $auth0->decodeJWT($accessToken);
                $user = $this->userRepository->getUserByDecodedJWT($tokenInfo);
                if (!$user) {
                    return response()->json(["message" => "Unauthorized user"], 401);
                }

                \Auth::login($user);

            } catch (InvalidTokenException $e) {
                return response()->json(["message" => $e->getMessage()], 401);
            } catch (CoreException $e) {
                return response()->json(["message" => $e->getMessage()], 401);
            }
        }

        return $next($request);
    }
}