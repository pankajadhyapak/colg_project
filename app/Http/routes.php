<?php

//Route::get("test", function(){
//
////generate Random String
//    $fileName = \Illuminate\Support\Str::random(10);
//    //$fileName = "filename";
//
//    $filePath = public_path().'/files/'.$fileName.'.php';
//    File::put($filePath, Request::get('code'));
//
//    $ContainerPath = public_path().'/files/'.$fileName.'Conatiner.php';
//
//    $mustache = new Mustache_Engine;
//
//    $examId = 1;
//    $examObj = \App\Question::find($examId);
//
//    $inputArray = $examObj->testCases->lists('input');
//    $outPutArray = $examObj->testCases->lists('output');
//
//    $tem = $mustache->render(file_get_contents(public_path()."/templates/php/Single.template"),[
//        'fileName' => $fileName,
//        'inputArray' => '['.implode(",",$inputArray).']',
//        'outPutArray' => '['.implode(",",$outPutArray).']'
//    ]);
//    file_put_contents($ContainerPath,$tem);
//
//
//
//});

Route::post('exam/codeExec', function(){

    return \Execute::run(Request::get('lang'));
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::resource('questions','QuestionsController');
Route::resource('questions.testcases','TestsCasesController');
Route::resource('exam','ExamController');