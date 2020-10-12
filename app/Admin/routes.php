<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group(array_merge(['namespace' => 'Codingyu\\LaravelUEditor'], config('ueditor.route.options', [])), function ($router) {
    $router->any(config('ueditor.route.name', '/ueditor/server'), '\Codingyu\LaravelUEditor\UEditorController@serve');
});

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('homepage_carousels', HomepageCarouselController::class);

    $router->resource('partners', PartnerController::class);

    $router->resource('experts', ExpertController::class);

    $router->resource('projects', ProjectController::class);

    $router->resource('sdgs', SustainableDevelopmentGoalController::class);

    $router->resource('sdgs_targets', SustainableDevelopmentGoalsTargetController::class);

    $router->resource('epapers', EpaperController::class);
});
