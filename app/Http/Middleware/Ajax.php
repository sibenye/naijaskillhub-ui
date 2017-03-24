<?php
namespace App\Http\Middleware;

use Closure;

class Ajax
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!$request->isXmlHttpRequest()) {
            abort(403);
        }

        $response = $next($request);

        if (array_key_exists('error', $response)) {
            return response()->json(
                    [
                            'status' => 'error',
                            'message' => $response ['error'],
                            'response' => NULL
                    ], 400);
        } else {
            return response()->json(
                    [
                            'status' => 'success',
                            'message' => NULL,
                            'response' => $response
                    ], 200);
        }
    }
}
