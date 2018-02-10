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

//Route::get('/', function () {
//    return view('welcome');
//});

//Группа маршрутов для вывода страниц сайта
Route::group(['middleware'=>'web'],function(){
    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);
    Route::auth();
});

//admin/service Группа маршрутов для вывода страниц админки
Route::group(['prefix'=>'admin','middleware'=>'auth'],  function (){
    
    //admin Вывод главной страницы админки
    Route::get('/',  function (){
        
    });
    
    //admin/pages Группа работы со страницами(pages)
    Route::group(['prefix'=>'pages'], function (){
        
        //admin/pages Маршрут главной страницы раздела по управлению страницами
        Route::get('/',['uses' => 'PagesController@execute','as' => 'pages']);
        
        //admin/pages/add Добавление страницы
        Route::match(['get','post'],'/add',['uses' => 'PagesAddController@execute',
            'as' => 'pagesAdd']);
        
        //admin/pages/edit/2  Редактирование страниц(изменение контента и удаления страниц)
        Route::match(['get','post','delete'],'/edit/{page}',
                     ['uses' => 'PagesEditController@execute',
                        'as' => 'pagesEdit']);
        
    });
    
    //admin/portfolios Группа маршрутов работы с портфолио(portfolios)
    Route::group(['prefix' => 'portfolios'], function (){
        
        //admin/portfolios Маршрут главной страницы раздела управления портфолио
        Route::get('/',['uses' => 'PortfolioController@execute', 'as' => 'portfolios']);
        
        //admin/portfolios/add Добавление страницы
        Route::match(['get','post'],'/add',['uses' => 'PortfolioAddController@execute',
            'as' => 'portfolioAdd']);
        
        //admin/portfolios/edit/2 Редактирование страниц(portfolio)
        //(изменение контента и удаления portfolio)
        Route::match(['get','post','delete'],'/edit/{portfolio}',
                    ['uses' => 'PortfolioEditController@execute',
                        'as' => 'portfolioEdit']);
        
    });
    
    //admin/services Группа маршрутов работы с services
    Route::group(['prefix' => 'services'], function (){
        
        //admin/services Маршрут главной страницы раздела управления services
        Route::get('/',['uses' => 'ServiceController@execute', 'as' => 'services']);
        
        //admin/services/add Добавление страницы
        Route::match(['get','post'],'/add',['uses' => 'ServiceAddController@execute',
            'as' => 'serviceAdd']);
        
        //admin/services/edit/2 Редактирование страниц(portfolio)
        //(изменение контента и удаления portfolio)
        Route::match(['get','post','delete'],'/edit/{service}',['uses' => 'ServiceEditController@execute',
            'as' => 'serviceEdit']);
        
    });

    
});