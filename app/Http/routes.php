<?php

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
/**
 * Ao testar no postman utilizar Headers
 */
Route::post('oauth/access_token', function(){
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware'=>'oauth'], function(){

    Route::resource('client', 'ClientController', ['except'=>['create', 'edit']]);
    Route::resource('project', 'ProjectController', ['except'=>['create', 'edit']]);

    Route::group(['prefix'=>'project'], function(){

        Route::get('{id}/note', 'ProjectNoteController@index');
        Route::post('{id}/note', 'ProjectNoteController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNoteController@show');
        Route::put('{id}/note/{noteId}', 'ProjectNoteController@update');
        Route::delete('{id}/note/{noteId}', 'ProjectNoteController@destroy');

        Route::get('{id}/task', 'ProjectTasksController@index');
        Route::post('{id}/task', 'ProjectTasksController@store');
        Route::get('{id}/task/{taskId}', 'ProjectTasksController@show');
        Route::put('{id}/task/{taskId}', 'ProjectTasksController@update');
        Route::delete('{id}/task/{taskId}', 'ProjectTasksController@destroy');

        Route::get('{id}/members', 'ProjectController@showMembers');

//        Route::post('{id}/file', 'ProjectFileController@store');
//        Route::get('{id}/file', 'ProjectFileController@index');
//        Route::get('{id}/file/{fileId}', 'ProjectFileController@show');
//        Route::put('{id}/file/{fileId}', 'ProjectFileController@update');
//        Route::delete('{id}/file/{fileId}', 'ProjectFileController@destroy');

        Route::get('{id}/file', 'ProjectFileController@index');
        Route::get('file/{fileId}', 'ProjectFileController@show');
        Route::get('file/{fileId}/download', 'ProjectFileController@showFile');
        Route::post('{id}/file', 'ProjectFileController@store');
        Route::put('file/{fileId}', 'ProjectFileController@update');
        Route::delete('file/{fileId}', 'ProjectFileController@destroy');

    });

});




