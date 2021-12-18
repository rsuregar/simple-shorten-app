<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $split = \Str::of($user->email)->explode('@')[1];

            // dd($user);

            switch ($split) {
                case 'alakhyar.sch.id':
                case 'siswa.alakhyar.sch.id':
                case 'edu.alakhyar.sch.id':
                    $finduser = User::updateOrCreate([
                        'email' => $user->email
                    ],[
                        'name' => $user->name,
                        'provider_id' => $user->id,
                        'password' => bcrypt($user->email)
                    ]);

                    Auth::login($finduser);
                    return redirect()->intended('/');
                    break;

                default:
                    return redirect()->back()->with(['msg' => 'Email yang Anda gunakan diluar dari ALAKHYAR ISLAMIC SCHOOL. Gunakan email ALAKHYAR.']);
                    break;
            }

        } catch (Exception $e) {
            return redirect()->back()->with(['msg' => 'Email yang Anda gunakan diluar dari ALAKHYAR ISLAMIC SCHOOL. Gunakan email ALAKHYAR.']);
        }
    }
}
