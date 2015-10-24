<?php namespace app\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except_urls = [
        'products/*',
        'orders/*',
    ];

    /**
     * Check the URL from which the request is made. It is used to exempt some routes where the exception TokenMismatchException is shown
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $regex = '#' . implode('|', $this->except_urls) . '#';

        if ($this->isReading($request) || $this->tokensMatch($request) || preg_match($regex, $request->path())) {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /*public function handle($request, Closure $next)
    {
        return parent::handle($request, $next);
    }*/
}
