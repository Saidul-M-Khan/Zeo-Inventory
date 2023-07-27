<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    function CategoryPage() {
        return view( 'pages.dashboard.category.index' );
    }

    function CategoryList( Request $request ) {
        try {
            $user_id    = $request->header( 'id' );
            $categories = Category::where( 'user_id', $user_id )->get();

            return response()->json( array(
                'status'  => 'success',
                'message' => 'Request Successful',
                'data'    => $categories,
            ), 200 );
        } catch ( Exception $exception ) {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'Something Went Wrong',
            ), 401 );
        }
    }

    function CategoryCreate( Request $request ) {
        $user_id = $request->header( 'id' );
        return Category::create( array(
            'name'    => $request->input( 'name' ),
            'user_id' => $user_id,
        ) );
    }

    function CategoryDelete( Request $request ) {
        $category_id = $request->input( 'id' );
        $user_id     = $request->header( 'id' );
        return Category::where( 'id', $category_id )->where( 'user_id', $user_id )->delete();
    }

    function CategoryUpdate( Request $request ) {
        $category_id = $request->input( 'id' );
        $user_id     = $request->header( 'id' );
        return Category::where( 'id', $category_id )->where( 'user_id', $user_id )->update( array(
            'name' => $request->input( 'name' ),
        ) );
    }
}
