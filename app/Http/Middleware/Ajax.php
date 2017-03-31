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

        $originalContent = $response->getOriginalContent();

        if (array_key_exists('error', $originalContent)) {
            return response()->json(
                    [
                            'status' => 'error',
                            'message' => $originalContent ['error'],
                            'response' => NULL
                    ], 400);
        } else {
            return response()->json(
                    [
                            'status' => 'success',
                            'message' => NULL,
                            'response' => $originalContent
                    ], 200);
        }
    }
}
