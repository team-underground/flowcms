<?php

namespace Flowcms\Flowcms\Middleware;

use Closure;

class HtmlMinifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;
    }

    public function minify($input)
    {
        $search = [
            '/\>\s+/s',
            '/\s+</s',
        ];

        $replace = [
            '> ',
            ' <',
        ];

        return preg_replace($search, $replace, $input);
    }
}
