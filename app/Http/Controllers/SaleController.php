<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    function getSalesInfo(Request $request){
        try{
            $user_id = $request->header('id');
            $sales = Sale::select('sales.id AS id', 'users.name AS business_name', 'users.email AS business_email', 'customers.name AS customer_name', 'customers.email AS customer_email', 'customers.mobile AS customer_mobile_no', 'products.name AS product_name', 'categories.name AS category_name', 'products.price AS unit_price', 'products.unit AS product_unit', 'products.img_url AS product_image', 'sales.purchased_quantity AS purchased_quantity', 'sales.total_price AS total_price', 'sales.payment_status AS payment_status')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->join('customers', 'customers.id', '=', 'sales.customer_id')
            ->join('products', 'products.id', '=', 'sales.product_id')
            ->join('categories', 'categories.id', '=', 'sales.category_id')
            ->where('sales.user_id', $user_id)
            ->orderBy('id', 'DESC')
            ->get();

            return response()->json( array(
                'status'  => 'success',
                'message' => 'Request Successful',
                'data'=>$sales
            ), 200 );
        }catch(Exception $exception){
            return response()->json( array(
                'status'  => 'fail',
                'message' => 'Something Went Wrong',
            ), 401 );
        }
    }
}
