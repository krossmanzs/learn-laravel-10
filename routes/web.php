<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    // fetch all users
    // $users = DB::select('select * from users');
    $users = DB::table('users')->where('id', 1)->get();
    
    // create new user
    // $user = DB::insert('insert into users (name, email, password) values (?,?,?)', [
    //     'Leenoogs',
    //     'bjir@gmial.com',
    //     Hash::make('test'),
    // ]);

    /*
        `=>` is used as an access mechanism for arrays
        `->` is used in object scope to access methods and properties of an object
        https://stackoverflow.com/questions/14037290/what-does-this-mean-in-php-or
    */

    // $user = DB::table('users')->insert([
    //     'name' => 'Bejir',
    //     'email' => 'wow@aa.com',
    //     'password' => 'omg'
    // ]);

    // update existing user
    // $user = DB::update('update users set name=? where name=?',[
    //     'test update',
    //     'Leenoogs'
    // ]);

    // $user = DB::table('users')->where('id',2)->update(['email' => 'hehe@g.com']);

    // delete a user
    // $deleted = DB::delete('delete from users where id=?',[2]);
    $deleted = DB::table('users')->where('id',2)->delete();

    dd($users);

    // default view
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
