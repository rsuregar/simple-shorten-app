<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

Route::get('/auth/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));
    $request->session()->put('role', $request->role);

    $query = http_build_query([
        'client_id' => '950e0002-3e7d-441b-ba8e-08c6d87368f9',
        'redirect_uri' => 'https://s.alakhyar.app/auth/callback',
        'response_type' => 'code',
        'scope' => '*',
        'state' => $state,
    ]);

    return redirect('https://sso.alakhyar.app/oauth/authorize?'.$query);
})->name('login.sso');

Route::get('/auth/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        \InvalidArgumentException::class
    );

    // return $request;

    $response = Http::withoutVerifying()->asForm()->post('https://sso.alakhyar.app/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => '950e0002-3e7d-441b-ba8e-08c6d87368f9',
        'client_secret' => 'Lf51RmxdIOnqKPauN5eT10ie9AbWVKKRQXA3QExkC',
        'redirect_uri' => 'https://s.alakhyar.app/auth/callback',
        'code' => $request->code,
    ]);

    $access_token = $request->session()->put('access_token', $response['access_token']);

    $user = Http::acceptJson()
                ->withoutVerifying()
                ->withToken($response['access_token'])->get('http://sso.alakhyar.app/api/user')->object();

    //loginOrCreate
    $save = User::updateOrCreate([
        'email' => $user->email,
    ],[
        'provider_id' => $user->provider_id ?? NULL,
        'name' => $user->name,
        'password' => bcrypt($user->email)
    ]);

    \Auth::login($save);

    return redirect('/');
});
