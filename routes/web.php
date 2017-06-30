<?php

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
// Route::get('/signin', 
// 		['uses' => 'UsersController@Signin']);


Route::group(['middleware' => 'guest'], function() {
   Route::match(['get', 'post'], '/', ['uses' => 'UsersController@Signin', 'as' => 'index']);
   Route::match(['get', 'post'], '/signup', ['uses' => 'UsersController@Signup', 'as' => 'users.signup']);
   Route::match(['get', 'post'], '/forgot_password', ['uses' => 'UsersController@forgotPassword']);
});
Route::get('/dashboard', 'UsersController@dashboard');
Route::get('/signout', ['uses' => 'UsersController@Signout', 'as' => 'signout']);
Route::get('/view_all_user', ['uses' => 'UsersController@view_all_user']);
Route::post('/add_new_category', ['uses'=>'RequestsController@addNewCategory']);


Route::group(['middleware' => 'auth'], function(){
	Route::post('view_submit_request', ['uses' => 'RequestsController@submitRequest']);
	Route::post('/update', ['uses' => 'RequestsController@update']);
	Route::post('/edit{each_post_id}', ['uses' => 'RequestsController@postEdit']);
	Route::post('view_edit_request', ['uses' => 'RequestsController@Edit', 'as' => 'users.view_request']);
	Route::match(['get','post'], 'users/edit', ['uses' => 'UsersController@editProfile', 'as' => 'users.edit']);
	Route::get('view_each_request/{id}', ['uses' => 'RequestsController@view_each_request', 'as' => 'users.view_each_request']);
	Route::get('view_request_category/{id}', ['uses' => 'RequestsController@view_each_category', 'as' => 'users.view_category']);
	Route::post('/search_result', ['uses' => 'RequestsController@getSearchResult']);

});

Route::group(['prefix' => 'users'], function(){
	Route::group(['middleware' => 'auth'], function(){
		Route::get('/request',
			['uses' => 'UsersController@getRequest',
			'as' => 'users.request'
		]);	
		Route::get('/view_request', 
			['uses' => 'RequestsController@viewRequest',
			'as' => 'users.view_request'
		]);	
		Route::post('/request', 
			['uses' => 'RequestsController@submitRequest'
		]);//end of button signup
		// Route::get('/edit/{id}', 
		// 	['uses' => 'RequestsController@getEdit',
		// 	'as' => 'users.edit'
		// ]);
		Route::get('delete_post/{post_id}', 
			['uses' => 'RequestsController@getDeletePost',
			 'as' => 'post.delete'
		]);

		
	});
});//end of prefix group