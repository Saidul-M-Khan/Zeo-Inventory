<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
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
        Route::get( "customers/create", 'CustomerCreatePage' );
        // Logic
        Route::get( "/list-customer", 'CustomerList' );
        Route::post( "/CustomerCreate", 'CustomerCreate' );
        Route::post( "/delete-customer", 'CustomerDelete' );
        Route::post( "/update-customer", 'CustomerUpdate' );
    } );
} );

// Category API
Route::controller( CategoryController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Logic
        Route::get( "/list-category", 'CategoryList' );
        Route::post( "/create-category", 'CategoryCreate' );
        Route::post( "/delete-category", 'CategoryDelete' );
        Route::post( "/update-category", 'CategoryUpdate' );
    } );
} );

// Product API
Route::controller( ProductController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Logic
        Route::get( "/list-product", 'ProductList' );
        Route::post( "/create-product", 'CreateProduct' );
        Route::post( "/delete-product", 'DeleteProduct' );
        Route::post( "/update-product", 'UpdateProduct' );
    } );
} );



// Sales API
Route::controller( SaleController::class )->group( function () {
    Route::middleware( array( TokenVerificationMiddleware::class ) )->group( function () {
        // Logic
        Route::get( "/getSalesInfo", 'getSalesInfo' );
    } );
} );




