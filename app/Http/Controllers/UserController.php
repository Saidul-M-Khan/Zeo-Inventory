<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken as JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class UserController extends Controller {
    // Pages
    function UserLoginPage(): View {
        return view( 'pages.auth.login' );
    }

    function UserSignupPage(): View {
        return view( 'pages.auth.signup' );
    }

    function SendOTPToEmailPage(): View {
        return view( 'pages.auth.forget-password' );
    }

    function VerifyOTPPage(): View {
        return view( 'pages.auth.otp-verification' );
    }

    function ResetPasswordPage(): View {
        return view( 'pages.auth.reset-password' );
    }

    function UserDashboardPage(): View {
        return view( 'pages.dashboard.dashboard' );
    }

    function ProfilePage(): View {
        return view( 'pages.dashboard.profile' );
    }

    // Logic
    function UserSignup( Request $request ) {
        try {
            User::create( array(
                'name'     => $request->input( 'name' ),
                'email'    => $request->input( 'email' ),
                'password' => $request->input( 'password' ),
            ) );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'User Registered Successfully',
            ), 200 );
        } catch ( Exception $e ) {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'User Registration Failed',
            ), 401 );
        }

    }

    function UserLogin( Request $request ) {
        $count = User::where( 'email', '=', $request->input( 'email' ) )
            ->where( 'password', '=', $request->input( 'password' ) )
            ->select( 'id' )->first();

        if ( $count !== null ) {
            // Issue JWT Token
            $token = JWTToken::CreateToken( $request->input( 'email' ), $count->id );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'User Login Successful',
            ), 200 )->cookie( 'token', $token, 60 * 60 * 24 );
        } else {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'User Login Failed',
            ), 401 );
        }

    }

    function SendOTPToEmail( Request $request ) {
        $email     = $request->input( 'email' );
        $otp       = rand( 100000, 999999 );
        $userCount = User::where( 'email', '=', $email )->count();

        if ( $userCount == 1 ) {
            // Send OTP To Users Email
            Mail::to( $email )->send( new OTPMail( $otp ) );
            // Update OTP To Table
            User::where( 'email', '=', $email )->update( array(
                'otp' => $otp,
            ) );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'OTP Sent Successfully',
            ), 200 );
        } else {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'OTP Send Failed',
            ), 401 );
        }

    }

    function VerifyOTP( Request $request ) {
        $email = $request->input( 'email' );
        $otp   = $request->input( 'otp' );
        $count = User::where( 'email', '=', $email )
            ->where( 'otp', '=', $otp )
            ->count();

        if ( $count == 1 ) {
            // OTP Update in Database
            User::where( 'email', '=', $email )
                ->update( array( 'otp' => '0' ) );
            // Issue a token to reset password
            $token = JWTToken::CreateTokenForResetPassword( $request->input( 'email' ) );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'OTP Verification Successful',
            ), 200 )->cookie( 'token', $token, 60 * 60 * 24 );
        } else {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'Authentication Failed',
            ), 401 );
        }

    }

    function ResetPassword( Request $request ) {
        try {
            $email    = $request->header( 'email' );
            $password = $request->input( 'password' );
            User::where( 'email', '=', $email )->update( array( 'password' => $password ) );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'Password Reset Successfully',
            ), 200 );
        } catch ( Exception $error ) {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'Password Reset Failed',
            ), 401 );
        }

    }

    function UserLogout() {
        return redirect( '/' )->cookie( 'token', '', -1 );
    }

    function UserProfile( Request $request ) {
        $email = $request->header( 'email' );
        $user  = User::where( 'email', '=', $email )->first();
        return response()->json( array(
            'status'  => 'success',
            'message' => 'Request Successful',
            'data'    => $user,
        ), 200 );
    }

    function UpdateProfile( Request $request ) {
        try {
            $email    = $request->header( 'email' );
            $name     = $request->input( 'name' );
            $mobile   = $request->input( 'mobile' );
            $password = $request->input( 'password' );
            User::where( 'email', '=', $email )->update( array(
                'name'     => $name,
                'mobile'   => $mobile,
                'password' => $password,
            ) );
            return response()->json( array(
                'status'  => 'success',
                'message' => 'Request Successful',
            ), 200 );

        } catch ( Exception $exception ) {
            return response()->json( array(
                'status'  => 'error',
                'message' => 'Something Went Wrong',
            ), 401 );
        }

    }

}
