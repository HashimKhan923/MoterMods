<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Socialite;

class SocialAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }
        // Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if a user with the Google email already exists
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if (!$user) {
                // Create a new user using Google data
                $user = new User();
                $user->name = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                // $user->google_id = $googleUser->getId(); // You can store Google ID if needed
                $user->user_type = 'customer';
                $user->avatar = $googleUser->getAvatar();
                $user->save();
            }
            
      
            
            // Redirect to a dashboard or other appropriate route
            
            $response = ['status'=>true,"message" => "Login Successfully",'user'=>$user];
            return response($response, 200);
        } catch (Exception $e) {
            // Handle any errors that might occur during the login process
            $response = ['status'=>true,"message" => "Login Failed"];
            return response($response, 200);
        }
    }

    // Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Check if a user with the Google email already exists
            $user = User::where('email', $facebookUser->getEmail())->first();
            
            if (!$user) {
                // Create a new user using Google data
                $user = new User();
                $user->name = $facebookUser->getName();
                $user->email = $facebookUser->getEmail();
                // $user->google_id = $facebookUser->getId(); // You can store Google ID if needed
                $user->user_type = 'customer';
                $user->avatar = $facebookUser->getAvatar();
                $user->save();
            }
            
            // Log in the user
            Auth::login($user);
            
            // Redirect to a dashboard or other appropriate route
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            $response = ['status'=>true,"message" => "Login Successfully",'token' => $token,'user'=>$user];
            return response($response, 200);
        } catch (Exception $e) {
            // Handle any errors that might occur during the login process
            $response = ['status'=>true,"message" => "Login Failed"];
            return response($response, 200);
        }
    }
}
