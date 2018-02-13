<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request) {
        
        //Проверка наличия представления для отображения данной формы
        if(view()->exists('admin.pages_add')){
            
        //Создаем переменную-массив с передаваемыми переменными в отображение:
        $data = [
            'title' => 'Новая страница'
        ];    
        
        return view('admin.pages_add', $data);
        }
        
        //Если отображение не найдено:
        abort(404);
    }
}
