<div class="wrapper container-fluid">
    
    <!-- Создаем форму -->
    {!! Form::open([
                    'url' => route('pagesEdit', array('page' => $data['id'])), 
                  'class' => 'form-horizontal',
                 'method' => 'POST',
                'enctype' => 'multipart/form-data'
                  ]) !!}
      <div class="form-group">
          <!-- Скрытое поле -->
          {!! Form::hidden('id', $data['id']) !!}
          {!! Form::label('name','Название: ', ['class' => 'col-xs-2 control-label']) !!}
          <div class="col-xs-8">
              {!! Form::text('name', $data['name'], ['class' => 'form-control', 'placeholder' => 'Введите название страницы']) !!}
          </div>
      </div>
      <div class="form-group">
          {!! Form::label('alias','Псевдоним: ', ['class' => 'col-xs-2 control-label'] ) !!}
          <div class="col-xs-8">
              {!! Form::text('alias', $data['alias'], ['class' => 'form-control', 'placeholder' => 'Введите псевдоним']) !!}
          </div>
      </div>
      <div class="form-group">
          {!! Form::label('text', 'Текст:',['class' => 'col-xs-2 control-label']) !!}
          <div class="col-xs-8">
              {!! Form::textarea('text', $data['text'], ['id' => 'editor', 'class' => 'form-control']) !!}
          </div>
      </div>
      <div class="form-group">
          {!! Form::label('old_images', 'Изображение:', ['class' => 'col-xs-2 control-label']) !!}
          <div class="col-xs-offset-2 col-xs-10">
              {!! Html::image('assets/img/'.$data['images'],'',['class' => 'img-circle']) !!}
              {!! Form::hidden('old_images', $data['images']) !!}
          </div>
      </div>
      <div class="form-group">
          {!! Form::label('images', 'Изображение: ', ['class' => 'col-xs-2 control-label']) !!}
          <div class="col-xs-8">
              {!! Form::file('images',[         'class' => 'filestyle',
                                            'data-text' => 'Выберите изображение',
                                        'data-btnClass' => 'btn-primary',
                                     'data-placeholder' => 'Файла нет']) !!}
          </div>
      </div>
      <div class="form-group">
         <div class="col-xs-offset-2 col-xs-10">
         <!-- Кнопка отправки формы: -->
         {!! Form::button('Сохранить', ['class' => 'btn btn-primary', 
                                         'type' => 'submit']) !!}
         </div>
      </div>
                 
      <!-- Закрывающий тэг формы -->             
      {!! Form::close() !!} 
      
       <!-- Подключаем визуальный редактор: -->
    <script>
            CKEDITOR.replace('editor');
    </script>
</div>
