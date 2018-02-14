<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use App\Page;

class PagesAddController extends Controller
{
    //
    public function execute(Request $request) {
        
        //Проверка типа поступившего запроса
        if($request->isMethod('POST')){
            
            //Заносим передаваемые данные в массив-переменную (кроме параметра _token)
            //исспользуем для этого метод, в котором можно указать исключения получаемых данных
            $input = $request->except('_token');
           
            //Определение выводимых ошибок при валидации вручную:
            $messages = [
                
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
                
            ];
            
            //Валидация данных пришедших из формы(1-что валидируем, 2 - правлила валидации):
            $validator = Validator::make($input,[
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required'
            ], $messages);
            
            //Проверка успешности валидации:
            if($validator->fails()){
                //В случае неуспешной валидации, перенаправление назад
                //на страничку добавления записей в БД, при этом в передаем
                //при помощи withErrors($validator) в сессию информацию об ошибках валидации.
                //И при помощи метода withInput() передаем через сессию информацию введенную пользователем.
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }
            
            //Проверка наличия файла переданного с формой
            if($request->hasFile('images')){
                         
                //file() возвращает объект специального класса Uploaded file
                // сохраняем данный экземпляр в переменную $file
                $file = $request->file('images');

                //Получаем реальное имя файла из объекта UploadedFile
                $input['images'] = $file->getClientOriginalName();
                
                //Переносим загружаемый файл в определенную директорию на сервере.
                //Для формирования пути исспльзуем ф-ю хелпер public_path() 
                //- возаращает путь к публичной директории Ларавель /public 
                //второй аргумент - имя сохраняемого файла $file->getClientOriginalName()
                $file->move(public_path().'/assets/img',$input['images']);
            }
            
            $page = new Page();
            
            //Заполним созданную модель $page
            $page->fill($input);
            
            //Сохраняем текущее состояение в табличку pages БД
            if($page->save()){
                //Перенаправляем на главную страничку админки: 
                //with() - передает данные в сессию
                return redirect('admin')->with('status','Страница добавлена');
            }

        }
        
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
