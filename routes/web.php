<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Task Admin usuario
Route::get('/task/admin', [TaskController::class, 'admin'])->name('admin');

//task create
Route::get('/task/create', [TaskController::class, 'create'])->name('create');

//show task by id
Route::get('/task/view/{id}', [TaskController::class, 'show'])->name('view');

//update task by id
Route::get('/task/update/{id}', [TaskController::class, 'update'])->name('update');

//edit task
Route::post('/task/updateStatus/{id}', [TaskController::class, 'updateStatus'])->name('updateStatus');

//store task
Route::post('/task/store', [TaskController::class, 'store'])->name('store')->middleware('sanitize');

//my profile
Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');


//change password
Route::get('/user/changePassword', [UserController::class, 'changePassword'])->name('changePassword');

//change password store
Route::post('/user/changePasswordStore', [UserController::class, 'changePasswordStore'])->name('changePasswordStore')->middleware('sanitize');

//auth google
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $userGoogle = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'google_id'=>$userGoogle->id
    ],
    [
        'name'=>$userGoogle->name,
        'email'=>$userGoogle->email,
    ]);
    Auth::login($user);
    return redirect('/task/admin');
});