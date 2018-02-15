<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;

class PagesEditController extends Controller
{
    /**
     * Редактирование заданной страницы
     * 
     * @param obj $request объект содержащий данные запроса
     * @param obj $page модель класса Page //id запроса применяется для формирования данной модели
     */  
    public function execute(Page $page,Request $request) {

        //Заносим значения полей модели $page в массив $old
        $old = $page->toArray();
        
        //Проверка существования макета для отображения на экран:
        if(view()->exists('admin.pages_edit')){
            
            //Формируем массив передаванемых данных в макет:
            $data = [
                
                'title' => 'Редактирование страницы - '.$old['name'],
                'data' => $old
            ];
            
            return view('admin.pages_edit',$data);
        }

    }
}
