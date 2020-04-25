<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    //部门管理
   /*  $router->get('/department', 'DepartmentController@index');
    $router->post('/department_store', 'DepartmentController@department_store');
    $router->get('/department/{id}/edit', 'DepartmentController@edit');
    $router->post('/department/{id}', 'DepartmentController@update'); */
    $router->resource('departmemts', DepartmentController::class);
    $router->resource('repairs', RepairController::class);
    //$router->get('repairs', 'RepairController@grid')->name('repair.grid');


});
