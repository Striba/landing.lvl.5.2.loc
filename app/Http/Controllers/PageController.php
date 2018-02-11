<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;

class PageController extends Controller
{
    //
    public function execute($alias) {
        
        //Проверка на наличие входящего алиаса названия страницы
        if(!$alias){
            //Ф-я хелпер:
            abort(404);
        }
        
        //Проверка на наличие соотв представления:
        if(view()->exists('site.page')){
            
            //В переменную получаем значение старицы в которой поле 'alias'
            // равно значению переменной $alias (очищенной ф-ей strip_tags)
            //  и ограничиваем все лишь одной записью
            $page = Page::where('alias', strip_tags($alias))->first();
            
            //Формируем переменную - массив передаваемых данных:
            $data = [
                
                'title' => $page->name,
                'page'  => $page
                
            ];
            
            return view('site.page', $data);
        } else {
            abort(404);
        }
    }
}
