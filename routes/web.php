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
Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('admin-login', 'AdminController@index')->name('admin-login');

Route::post('login-admin', 'AdminController@login')->name('login-admin');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', "HomeController@admin");

//User

Route::resource('admin/users', 'Admin\UsersController');

Route::get('users-search', 'Admin\UsersController@search')->name('users-search');

Route::get('manage-users', 'Admin\UsersController@manageUsers')->name('manage-users');

Route::post('users/export', 'Admin\UsersController@export')->name('users/export');

Route::get('/usersPDF','Admin\UsersController@downloadPDF');

Route::get('user/profile/', 'Admin\UsersController@profile')->name('user/profile');

Route::post('user/profile', 'Admin\UsersController@avatar')->name('user/profile');

Route::delete('user/profile-unsubscribe/', 'Admin\UsersController@unsubscribe')->name('user/profile-unsubscribe');

Route::get('user/subscribe/', 'Admin\UsersController@subscribe')->name('user/subscribe');

Route::post('user/subscribe/', 'Admin\UsersController@subscribeUser')->name('user/subscribe');

//categories

Route::resource('categories', 'CategoryController');

//Route::delete('category-delete/{id}', 'CategoryController@delete')->name('category-delete');

//Route::get('categories-manage', 'CategoryController@manage')->name('categories-manage');

//Route::get('category-search', 'CategoryController@search');

Route::get('category-search/{id}', 'CategoryController@search')->name('category-search');

//Route::get('category2', 'CategoryController@manage')->name('category2');

Route::get('/categoriesPDF','CategoryController@downloadPDF')->name('categoriesPDF');

//polls
Route::get('/pollsPDF','PollController@downloadPDF')->name('pollsPDF');

Route::resource('polls', 'PollController');

//Route::resource('poll', 'Poll2Controller');

Route::post('polls.newpoll', 'PollController@newpoll')->name('polls.newpoll');

Route::delete('polls/{id}', 'PollController@destroy');

//Route::get('polls-manage', 'PollController@manage')->name('polls-manage');

Route::get('polls-manage', 'PollController@managePools')->name('polls-manage');

Route::get('poll/result', 'PollController@result');

Route::delete('poll/delete/{id}', 'PollController@deletePoll')->name('poll/delete');

Route::post('polls/export', 'PollController@export')->name('polls/export');

Route::post('poll/comments', 'PollController@storeComments')->name('poll/comments');

Route::get('poll/comments', 'PollController@storeComments')->name('poll/comments');

Route::get('poll-all/{id}', 'PollController@allPolls')->name('poll-all');

Route::get('poll-related/{id}', 'PollController@signup')->name('poll-related');


//post

Route::resource('posts', 'PostController');

Route::get('posts-search', 'PostController@search')->name('posts-search');

Route::get('posts-manage', 'PostController@managePosts')->name('posts-manage');

Route::get('/postsPDF','PostController@downloadPDF');

Route::delete('post-delete/{id}', 'PostController@postDelete')->name('post-delete');

//Route::get('post-group', 'PostController@searchGroups')->name('post-group');

Route::get('post-group/{id}', 'PostController@searchGroups')->name('post-group');

Route::get('post-tag-search/{post}', 'PostController@tagSearch')->name('post-tag-search');


//signup

Route::resource('signup', 'SignupController');

Route::resource('signups', 'SignController');

Route::get('new-signup','SignController@newSign')->name('new-signup');

//Route::resource('signup-title', 'SignupTitleController');

//Route::get('signup-manage', 'SignupTitleController@manage')->name('signup-manage');

//Route::get('signup-manage', 'SignupTitleController@manageSignup')->name('signup-manage');
Route::post('signup/update/{id}', 'SignController@update')->name('signup/update');

Route::post('signup/export', 'SignController@export')->name('signup/export');

Route::get('/signupsPDF','SignController@downloadPDF')->name('signupsPDF');

Route::get('signup-all/{id}', 'SignController@allSignups')->name('signup-all');

Route::post('signup-archive', 'SignController@storeArchive')->name('signup-archive');



//massage

Route::get('/massage', 'MassageController@index')->name('massage');

Route::delete('massage.destroy/{id}', 'MassageController@destroy')->name('massage.destroy');

Route::put('massage.update/{id}', 'MassageController@update')->name('massage.update');

Route::get('massage.create', 'MassageController@create')->name('massage.create');

Route::post('massage.store', 'MassageController@store')->name('massage.store');

//Route::put('/generate-json', 'MassageController@generateJson')->name('generate-json');

Route::put('/massage-user.store/{id}', 'MassageUserController@store')->name('massage-user.store');

Route::delete('massage.delete', 'MassageController@deleteTime')->name('massage.delete');

Route::get('massage.edit/{id}', 'MassageController@edit')->name('massage.edit');

Route::get('massage-view', 'MassageController@massageView')->name('massage-view');

Route::get('manage-massage', 'MassageController@manageMassage')->name('manage-massage');

Route::post('massage/export', 'MassageController@export')->name('massage/export');

Route::get('stripe', 'MassageUserController@stripe')->name('stripe');

Route::post('stripe', 'MassageUserController@stripePost')->name('stripe.post');

Route::put('massage-paid','MassageUserController@paid')->name('massage-paid');

Route::post('comments.store', 'CommentController@store')->name('comments.store');

//Subscribe

Route::get('subscribe', 'SubscribeController@index')->name('subscribe');

Route::post('subscribe/destroy', 'SubscribeController@delete')->name('subscribe/destroy');

//Groups
Route::resource('groups', 'GroupController');
Route::resource('group', 'GroupController');

//Route::put('groups.update/{id}','GroupController@update')->name('groups.update');

Route::get('groups-manage-users', 'GroupController@manageUsers')->name('groups-manage-users');

Route::post('groups/destroy', 'GroupController@destroyGroup')->name('groups/destroy');

//Tag
Route::resource('tags', 'TagController');

Route::get('new-tag', 'TagController@newTag')->name('new-tag');


//News comments
Route::post('/comment/store', 'CommentController@store')->name('comment.add');

Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

//Poll comments
Route::post('poll/comment/store', 'PollCommentController@store')->name('poll.comment.add');

Route::post('poll/reply/store', 'PollCommentController@replyStore')->name('poll.reply.add');

//Contact
Route::get('contact-us', 'ContactController@contactUS')->name('contact-us');

Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactController@contactUSPost']);

//Clear cache
Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');

    dd("Cache Clear All");
});
