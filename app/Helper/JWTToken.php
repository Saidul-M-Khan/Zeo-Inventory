<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {

    public static function CreateToken( $userEmail, $userID ): string{
        $key     = env( 'JWT_KEY' );
        $payload = array(
            "iss"       => "Laravel JWT",
            "aud"       => "Users",
            "iat"       => time(),
            "exp"       => time() + 60 * 60,
            "userEmail" => $userEmail,
            "userID"    => $userID,
        );
        return JWT::encode( $payload, $key, 'HS256' );
    }

    public static function VerifyToken( $token ) {
        try {

            if ( $token == null ) {
                return 'unauthorized';
            } else {
                $key     = env( 'JWT_KEY' );
                $decoded = JWT::decode( $token, new Key( $key, 'HS256' ) );
                return $decoded;
            }

        } catch ( Exception $e ) {
            return 'unauthorized';
        }
    }

    public static function CreateTokenForResetPassword( $userEmail ): string{
        $key     = env( 'JWT_KEY' );
        $payload = array(
            "iss"       => "Laravel JWT",
            "aud"       => "Users",
            "iat"       => time(),
            "exp"       => time() + 60 * 5,
            "userEmail" => $userEmail,
            "userID"    => "0",
        );
        return JWT::encode( $payload, $key, 'HS256' );
    }

}
