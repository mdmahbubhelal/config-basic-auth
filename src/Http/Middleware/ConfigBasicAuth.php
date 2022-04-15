<?php

namespace MdMahbubHelal\ConfigBasicAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ConfigBasicAuth
{
    public function handle($request, Closure $next)
    {
        $users = collect(config('basicauth.users', []));

        $correctCredentialPassed = $users
            ->where('username', $request->getUser())
            ->where('password', $request->getPassword())
            ->isNotEmpty();

        if ($correctCredentialPassed) {
            return $next($request);
        }

        $headers = ['WWW-Authenticate' => 'Basic'];

        abort(Response::HTTP_UNAUTHORIZED, '', $headers);
    }
}
