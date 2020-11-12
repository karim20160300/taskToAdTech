<?php
Route::group(['prefix' => 'v1'],function(){

    //general unauthenticated routes here 

    Route::group(['prefix' => 'admin'],function(){

        Route::post('sign-up','AdminAuthController@signUp');
        Route::post('log-in','AdminAuthController@logIn');
    //unauthenticated routes for admins here               

    Route::group( ['middleware' => ['auth:admin'] ],function(){
           // authenticated admin routes here 
           Route::post('user','AdminAuthController@details');
           Route::post('log-out','AdminAuthController@logOut');
           Route::resource('section','SectionController');
           Route::resource('student','StudentController');
        //    Route::post('test','AdminAuthController@test');
        });
        
    });
    

});
