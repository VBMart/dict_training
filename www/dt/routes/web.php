<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkdb', function (){
    // Test database connection
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
    if(DB::connection()->getDatabaseName())
    {
        return "connected successfully to database: ".DB::connection()->getDatabaseName();
    }else{
        return 'failed';
    }
});


Route::get('/test', function (Request $request) {
    $text = $request->get('show');

    return view('test', [
        'text' => $text,
        'user' =>  $request->get('username'),
    ]);
});

Route::get('files/add', function (Request $request){
    $request->validate([
        'filename'=>'required|unique:files,file_name',
    ]);

    $file = new \App\File([
        'file_name' => $request->get('filename'),
        'using' => 1
    ]);

    $file->save();

    return redirect('/files');
});

Route::get('/files', function (Request $request){


    $files = \App\File::all();

    return view('files', [
        'files' => $files
    ]);
});
