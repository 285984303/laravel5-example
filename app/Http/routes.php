<?php

// Home
Route::get('/', [
	'uses' => 'HomeController@index',
	'as' => 'home'
]);
Route::get('language', 'HomeController@language');

//test
/*1�����ж�Ӧ�ķ�����·��
 * Route::match(['get', 'post'], '/', function () {
    return 'Hello World';
});
 */
/*2������fooΪ��������·��
 * Route::any('foo', function () {
    return 'Hello World';
});
 */
/*
 * 3������·�ɣ������в���
 * Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
});
 */
/*4����ѡ����·��
 * Route::get('user/{name?}', function ($name = null) {
    return $name;
});

Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});
 */
/*5����������ƥ��·��
 * Route::get('user/{id}/{name}', function ($id, $name) {
	//
})
	->where(['id' => '[0-9]+', 'name' => '[a-z]+']);*/
/*
 * 6��RouteServiceProvider�е�boot�������Զ��幫���Ĳ�������ƥ�䣬���£�
 * public function boot(Router $router)
{
    $router->pattern('id', '[0-9]+');

    parent::boot($router);
}
Route::get('user/{id}', function ($id) {
	return $id;
});
 */
/*
 * 7����·��һ��������ò���ǣ�
 * Route::get('user/profile', ['as' => 'profile', function () {
    //
}]);
��������ʹ��
Route::match(['get', 'post'], '/', function () {
	return redirect()->route('profile');
});
 */
/*
 * 8��·�������ƹ���
 * Route::group(['as' => 'admin::'], function () {
    Route::get('dashboard', ['as' => 'dashboard', function () {
        // Route named "admin::dashboard"
        return "Test Group!";
    }]);
});
����ʹ�ã�
Route::get('user/profile', ['as' => 'profile', function () {
	return redirect()->route("admin::dashboard");
}]);
 */
/*
 * 9������route��������
 * Route::get('user/{id}/profile', ['as' => 'profile', function ($id) {
    //
}]);

$url = route('profile', ['id' => 1]);
 */
/*
 * 10��Middleware�м����ʹ��
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', function ()    {
		// Uses Auth Middleware
	});

	Route::get('user/profile', function () {
		// Uses Auth Middleware
	});
});
�������е����󶼻�����ת��auth��
 */
/*
 * 11��ʹ�������ռ�
 * Route::group(['namespace' => 'Admin'], function()
{
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    Route::group(['namespace' => 'User'], function()
    {
        // Controllers Within The "App\Http\Controllers\Admin\User" Namespace
    });
});
 */
/*
 * 12��ʹ�����淽ʽ���Ի�ȡ��ǰ��������Ϣ
 * Route::group(['domain' => '{account}.myapp.com'], function () {
    Route::get('user/{id}', function ($account, $id) {
        return "Account:".$account.";"."Id:".$id;
    });
});
 */
/*
 * 13����·������ǰ׺
 * Route::group(['prefix' => 'admin'], function () {
    Route::get('users', function ()    {
        // Matches The "/admin/users" URL
    });
});
��������
Route::group(['prefix' => 'accounts/{account_id}'], function () {
    Route::get('detail', function ($account_id)    {
        // Matches The accounts/{account_id}/detail URL
          return "Detail!!";
    });
});
 */
// Admin
Route::get('admin', [
	'uses' => 'AdminController@admin',
	'as' => 'admin',
	'middleware' => 'admin'
]);

Route::get('medias', [
	'uses' => 'AdminController@filemanager',
	'as' => 'medias',
	'middleware' => 'redac'
]);


// Blog
Route::get('blog/order', ['uses' => 'BlogController@indexOrder', 'as' => 'blog.order']);
Route::get('articles', 'BlogController@indexFront');
Route::get('blog/tag', 'BlogController@tag');
Route::get('blog/search', 'BlogController@search');

Route::put('postseen/{id}', 'BlogController@updateSeen');
Route::put('postactive/{id}', 'BlogController@updateActive');

Route::resource('blog', 'BlogController');

// Comment
Route::resource('comment', 'CommentController', [
	'except' => ['create', 'show']
]);

Route::put('commentseen/{id}', 'CommentController@updateSeen');
Route::put('uservalid/{id}', 'CommentController@valid');


// Contact
Route::resource('contact', 'ContactController', [
	'except' => ['show', 'edit']
]);


// User
Route::get('user/sort/{role}', 'UserController@indexSort');

Route::get('user/roles', 'UserController@getRoles');
Route::post('user/roles', 'UserController@postRoles');

Route::put('userseen/{user}', 'UserController@updateSeen');

Route::resource('user', 'UserController');

// Auth
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
