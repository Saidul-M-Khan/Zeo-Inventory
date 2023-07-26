<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller {
    /* Pages */
    function ProductPage(): View {
        return view( 'pages.dashboard.products.index' );
    }

    /* Create Product */
    function CreateProduct( Request $request ) {
        $user_id = $request->header( 'id' );

        // Prepare file name and path
        $image      = $request->file( 'image' );
        $time       = time();
        $file_name  = $image->getClientOriginalName();
        $image_name = "{$user_id}-{$time}-{$file_name}";
        $image_url  = "uploads/{$image_name}";

        // Upload file
        $image->move( public_path( 'uploads' ), $image_name );

        // Save To Database
        return Product::create( array(
            'name'        => $request->input( 'name' ),
            'price'       => $request->input( 'price' ),
            'unit'        => $request->input( 'unit' ),
            'img_url'     => $image_url,
            'category_id' => $request->input( 'category_id' ),
            'user_id'     => $user_id,
        ) );
    }

    /* Delete Product */
    function DeleteProduct( Request $request ) {
        $user_id    = $request->header( 'id' );
        $product_id = $request->input( 'id' );
        $filePath   = $request->input( 'file_path' );
        File::delete( $filePath );
        return Product::where( 'id', $product_id )->where( 'user_id', $user_id )->delete();
    }

    /* Show Product Lists */
    function ProductList( Request $request ) {
        $user_id = $request->header( 'id' );
        return Product::where( 'user_id', $user_id )->get();
    }

    /* Update Product Info */
    function UpdateProduct( Request $request ) {
        $user_id    = $request->header( 'id' );
        $product_id = $request->input( 'id' );

        if ( $request->hasFile( 'image' ) ) {

            // Upload New File
            $image       = $request->file( 'image' );
            $time         = time();
            $file_name = $image->getClientOriginalName();
            $image_name  = "{$user_id}-{$time}-{$file_name}";
            $image_url   = "uploads/{$image_name}";
            $image->move( public_path( 'uploads' ), $image_name );

            // Delete Old File
            $filePath = $request->input( 'file_path' );
            File::delete( $filePath );

            // Update Product

            return Product::where( 'id', $product_id )->where( 'user_id', $user_id )->update( array(
                'name'        => $request->input( 'name' ),
                'price'       => $request->input( 'price' ),
                'unit'        => $request->input( 'unit' ),
                'img_url'     => $image_url,
                'category_id' => $request->input( 'category_id' ),
            ) );

        } else {
            return Product::where( 'id', $product_id )->where( 'user_id', $user_id )->update( array(
                'name'        => $request->input( 'name' ),
                'price'       => $request->input( 'price' ),
                'unit'        => $request->input( 'unit' ),
                'category_id' => $request->input( 'category_id' ),
            ) );
        }

    }

}
