<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller {
    function DashboardPage(): View {
        return view( 'pages.dashboard.dashboard' );
    }

    function TotalCustomer( Request $request ) {
        $id = $request->header( 'id' );
        return Customer::where( 'user_id', $id )->count();
    }

    function TotalCategory( Request $request ) {
        $id = $request->header( 'id' );
        return Category::where( 'user_id', $id )->count();
    }

    function TotalProduct( Request $request ) {
        $id = $request->header( 'id' );
        return Product::where( 'user_id', $id )->count();
    }
}
