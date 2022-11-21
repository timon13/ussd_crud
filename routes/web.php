<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Ussd
    Route::delete('ussds/destroy', 'UssdController@massDestroy')->name('ussds.massDestroy');
    Route::resource('ussds', 'UssdController');

    // Ussd Menu
    Route::delete('ussd-menus/destroy', 'UssdMenuController@massDestroy')->name('ussd-menus.massDestroy');
    Route::post('ussd-menus/media', 'UssdMenuController@storeMedia')->name('ussd-menus.storeMedia');
    Route::post('ussd-menus/ckmedia', 'UssdMenuController@storeCKEditorImages')->name('ussd-menus.storeCKEditorImages');
    Route::resource('ussd-menus', 'UssdMenuController');

    // Payment
    Route::resource('payments', 'PaymentController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Session
    Route::resource('sessions', 'SessionController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Session
    Route::resource('user-sessions', 'UserSessionController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
