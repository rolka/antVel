<?php namespace app\Http\Middleware;

use App\Http\Controllers\OrdersController;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        /**
         * If there is products into the guest cart, its content is transferred
         * to a logged user 'cart' order.
         */

        if (\Illuminate\Support\Facades\Session::has('user.cart_content')) {
            $ordersController = new OrdersController();
            $ordersController->fromGuestToUser($ordersController);
            unset($ordersController);
        }

        return $next($request);
    }
}
