<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{ShortLinkController, SocialiteController};
use Illuminate\Foundation\Auth\EmailVerificationRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{url?}', function ($url=null) {
    if (!is_null($url)) {
        $get = \App\Models\ShortLink::where('short_link', $url)->firstOrFail();
        $get->increment('num_of_clicks');
        $get->clicks()->create([
            'short_link_id' => $get->id,
            'ip' => request()->ip()
        ]);
        return redirect()->away($get->origin_link);
    }elseif (\Auth::check()) {
        return redirect()->route('form.create');
    }else{
        return view('auth.login');
    }

})->name('homepage');

Route::post('auth/login', function(Request $request){

    $request->validate([
            'email'     => 'required|exists:users,email|string',
            'password'  => 'required'
        ],[
            'email.required' => 'Akun Anda salah. Coba ulangi lagi',
            'email.exists' => 'Akun anda tidak ditemukan dalam sistem kami.',
            'password.required' => 'Harap masukkan password yang benar.'
        ]);

        if(\Auth::attempt(['email' => $request->email, 'password' => $request->password], true)){
            request()->session()->regenerate();
            return redirect()->route('form.create');
        }
})->name('login');


Route::post('auth/register/post', function(Request $request){
    $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required',
            'cpassword' => 'same:password'
        ]);

    $emailOke = \Str::of($request->email)->explode('@')[1];

    if ($emailOke == 'alakhyar.sch.id' || $emailOke == 'edu.alakhyar.sch.id' || $emailOke == 'siswa.alakhyar.sch.id') {
        $user = \App\Models\User::firstOrCreate([
            'email' => $request->email
        ],[
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'remember_token' => \Str::random(64)
        ]);

        \Auth::login($user);
        return redirect()->intended('/');
    }else{
        return redirect()->back()->withInput()->with(['msg' => 'Email yang Anda gunakan diluar dari ALAKHYAR ISLAMIC SCHOOL. Gunakan email ALAKHYAR.']);
    }

})->name('register');

Route::view('auth/register', 'auth.register')->name('register.akun');


Route::middleware(['auth'])->group(function () {
    // Route::view('app/create', 'shortlink');
    Route::get('app/create/{slug?}', [ShortLinkController::class, 'create'])->name('form.create');
    Route::post('app/store', [ShortLinkController::class, 'store'])->name('form.store');
    Route::post('app/delete', [ShortLinkController::class, 'delete'])->name('form.delete');
    Route::post('app/update/{shortlink}', [ShortLinkController::class, 'update'])->name('form.update');
});


Route::post('auth/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('user/agent', function(){
    return request()->userAgent();
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);


require __DIR__.'/sso.php';
