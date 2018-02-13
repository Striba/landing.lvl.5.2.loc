<div style="margin: 0px 50px 0px 50px;">

@if($pages)    
<!-- проверка наличия содержимого в переменной $pages-->    
    
    <table>
        <thead>
            <tr>
                <th>№ п/п</th>
                <th>Имя</th>
                <th>Псевдоним</th>
                <th>Текст</th>
                <th>Дата создания</th>
                <th>Удалить</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $k => $page)
            
            <tr>
                <td>{{$page->id}}</td>
                <!-- //> Формируем ссылку -->
                <td>{!! Html::link(route('pagesEdit',['page' => $page->id]),
                    $page->name, ['alt' => $page->name]) !!}</td>
                <!-- //< -->
                <td>{{$page->alias}}</td>
                <td>{{$page->text}}</td>
                <td>{{$page->created_at}}</td>
                <td>
                    <!-- Создаем форму обращения для удаления -->
                    <!-- <form> -->
                    {!! Form::open(['url' => route('pagesEdit',['page' => $page->id]),
                                  'class' => 'form-horizontal',
                                 'method' => 'POST']) !!}

                    <!-- Создаем скрытое поле: -->
                    {!! Form::hidden('action','delete') !!}
                    <!-- Создаем кнопку -->
                    {!! Form::button('Удалить',['class'=>'btn btn-danger','type'=>'submit']) !!}
                    <!-- </form> -->
                    {!! Form::close() !!}
                </td>
            </tr>
            
            @endforeach
        </tbody
    </table>
@endif

<!-- Ссылка на форму добавления нового материала -->
{!! Html::link(route('pagesAdd'),'Новая страница') !!}
</div>