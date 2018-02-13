<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //
    public function execute() {
        
        //Проверка на наличие существования шаблона для отображения страниц
        if(view()->exists('admin.pages')){
            
            //Заносим все страницы нашего сайта во временную переменную
            $pages = \App\Page::all();//пример локального подключения класса
            
            //Формируем перемунную-массив данных для передачи данных в шаблон
            $data = [
                'title' => 'Страницы',
                'pages' => $pages,
            ];
            
            return view('admin.pages',$data);
        } else {
          abort(404);  
        }
    } 
}
