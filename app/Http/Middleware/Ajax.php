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

        if (is_array($originalContent) && array_key_exists('error', $originalContent)) {
            return response()->json(
                    [
                            'status' => 'error',
                            'message' => $originalContent ['error'],
                            'response' => NULL
                    ], $response->status() === 200 ? 400 : $response->status());
        } else if (is_array($originalContent)) {
            return response()->json(
                    [
                            'status' => 'success',
                            'message' => NULL,
                            'response' => $originalContent
                    ], 200);
        } else {
            return $response;
        }
    }
}
