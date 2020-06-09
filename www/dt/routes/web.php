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

Route::get('/sentence/{id}', function (Request $request, $id){
    $sentence = \App\Sentence::findOrFail($id);
    dump($sentence->en);
    dump($sentence->ru);
    foreach ($sentence->words as $word) {
        dump($word->word);
    }
});

Route::get('/word/id/{id}', function (Request $request, $id){
    $word = \App\Word::findOrFail($id);

    return redirect()->route('word.show', ['var' => $word->word]);
});

Route::get('/word/{var}', function (Request $request, $var){
    $word = \App\Word::where('word', $var)->with('sentences')->firstOrFail();

    return view('word_sentences', [
        'word' => $word,
    ]);
})->name('word.show');

Route::get('/test/{level:name}', 'TestWordsController@randomTest')->name('test.random');
Route::POST('/test/{level:name}', 'TestWordsController@checkRandomTest');
Route::get('/test', 'TestWordsController@selectLevel');



/*
Route::get('/seed', function (Request $request){
    $request->validate([
        'filename'=>'required',
    ]);

    $ss = new SentencesSeeder();
    $ss->seedFile($request->get('filename'));
});
*/

/*
Route::get('/seed/{level}', function (Request $request, $level) {

    $ds = new DictionarySeeder();
    $ds->seedLevel($level);
});
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
