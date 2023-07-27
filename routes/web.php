<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'home' );
} );

Route::get( '/about-us', function () {
    return view( 'pages.about-us' );
} );

Route::get( '/contact-us', function () {
    return view( 'pages.contact-us' );
} );

/* Ajax Call Route */
// Users
Route::controller( UserController::class )->group( function () {
    // Pages
    Route::get( '/signup', 'UserSignupPage' );
    Route::get( '/login', 'UserLoginPage' );
    Route::get( '/forget-password', 'SendOTPToEmailPage' );
    Route::get( '/verify-otp', 'VerifyOTPPage' );
    Route::get( '/reset-password', 'ResetPasswordPage' )->middleware( array( TokenVerificationMiddleware::class ) );
    Route::get( '/profile', 'ProfilePage' )->middleware( array( TokenVerificationMiddleware::class ) );
    // User Authentication
    Route::post( '/UserSignup', 'UserSignup' );
    Route::post( '/UserLogin', 'UserLogin' );
    Route::post( '/SendOTPToEmail', 'SendOTPToEmail' );
    Route::post( '/VerifyOTP', 'VerifyOTP' );
    Route::post( '/ResetPassword', 'ResetPassword' )->middleware( array( TokenVerificationMiddleware::class ) );
    Route::get( '/UserLogout', 'UserLogout' )->middleware( array( TokenVerificationMiddleware::class ) );
    // Logic
    Route::get( '/UserProfile', 'UserProfile' )->middleware( array( TokenVerificationMiddleware::class ) );
    Route::post( '/UpdateProfile', 'UpdateProfile' )->middleware( array( TokenVerificationMiddleware::class ) );
} );

// Dashboard API
Route::controller( DashboardController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Pages
        Route::get( '/dashboard', 'DashboardPage' );
        // Logic
        Route::get( "/total-customer", 'TotalCustomer' );
        Route::get( "/total-category", 'TotalCategory' );
        Route::get( "/total-product", 'TotalProduct' );
    } );
} );

// Customer API
Route::controller( CustomerController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Pages
        Route::get( "customers", 'CustomerPage' );
        // Logic
        Route::get( "/CustomerList", 'CustomerList' );
        Route::post( "/CustomerCreate", 'CustomerCreate' );
        Route::post( "/CustomerDelete", 'CustomerDelete' );
        Route::post( "/CustomerUpdate", 'CustomerUpdate' );
    } );
} );

// Category API
Route::controller( CategoryController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Pages
        Route::get( "/categories", 'CategoryPage' );
        // Logic
        Route::get( "/CategoryList", 'CategoryList' );
        Route::post( "/CategoryCreate", 'CategoryCreate' );
        Route::post( "/CategoryDelete", 'CategoryDelete' );
        Route::post( "/CategoryUpdate", 'CategoryUpdate' );
    } );
} );

// Product API
Route::controller( ProductController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Pages
        Route::get( "/products", 'ProductPage' );
        // Logic
        Route::get( "/ProductList", 'ProductList' );
        Route::post( "/CreateProduct", 'CreateProduct' );
        Route::post( "/DeleteProduct", 'DeleteProduct' );
        Route::post( "/UpdateProduct", 'UpdateProduct' );
    } );
} );



// Sales API
Route::controller( SaleController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        Route::get( "/sales", 'SalesPage' );
        // Logic
        Route::get( "/getSalesInfo", 'getSalesInfo' );
    } );
} );




