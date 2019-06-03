<?php



Auth::routes();

Route::group(['middleware' => 'auth'], function () {

//    TASK ROTE
    Route::get('', 'TaskController@index')->name('tasks.index');
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('create', 'TaskController@create')->name('tasks.create');
        Route::post('store', 'TaskController@store')->name('tasks.store');
        Route::get('edit/{task}', 'TaskController@edit')->name('tasks.edit');
        Route::put('update/{task}', 'TaskController@update')->name('tasks.update');
        Route::get('view/{task}', 'TaskController@view')->name('tasks.view');
        Route::put('change-status/{task}', 'TaskController@changeStatus')->name('tasks.change_status');
        Route::get('get-developers', 'TaskController@getDevelopers')->name('tasks.get_developers');
    });

});
