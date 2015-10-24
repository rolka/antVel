<?php namespace app\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    /**
     * [searchAll description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function searchAll(Request $request)
    {
        $crit = $request->get('crit');
        $response['products'] = array('results'=>null,'suggestions'=>null);

        if ($crit != '') {
            $response['products']['results'] = Product::where('status', 1)->search($crit)->Free()->take(5)->get();
        }
        $response['products']['suggestions'] = ProductsController::getSuggestions(['user_id'=>\Auth::id(), 'preferences_key'=>'my_searches', 'limit'=>3]);

        if ($request->wantsJson()) {
            return json_encode($response);
        }
    }
}
