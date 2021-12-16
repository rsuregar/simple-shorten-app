<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{ShortLinkController};

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
            'email.required' => 'Harap masukkan email yang telah diberikan.',
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

    if ($emailOke == 'alakhyar.sch.id' || $emailOke == 'edu.alakhyar.sch.id') {
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


Route::middleware(['auth', 'verified'])->group(function () {
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
