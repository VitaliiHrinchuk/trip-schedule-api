<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CORS
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
        $allow_headers = [
            'Content-Type',
            'Authorization',
            'X-Requested-With',
            'Cache-Control',
        ];

        $content_types = [
            'multipart/form-data',
            'application/json',
            'application/x-www-form-urlencoded',
            'text/plain',
        ];

        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'OPTIONS, POST, GET, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => implode(', ', $allow_headers),
            # 'Content-Type' 					   => implode(', ', $content_types),
        ];


        if ($request->isMethod('OPTIONS')) {
            return new Response(null, 204, $headers);
        }

        $response = $next($request);

        // Ignore file response
        if ($response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
            foreach($headers as $key => $value) {
                $response->headers->set($key, $value);
            }
            return $response;
        }

        foreach($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}