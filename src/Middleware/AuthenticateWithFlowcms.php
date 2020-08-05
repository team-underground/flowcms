<?php

namespace Flowcms\Flowcms\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateWithFlowcms extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('flowcms::login');
        }
    }
}
