<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;
use App\Service;
use App\Portfolio;
use App\People;

use DB;

class IndexController extends Controller
{
    //
    public function execute(Request $request) {//принимаем аргрумент - объект класса Request
        
        $pages = Page::all();//выбераем все записи из таблички page
        $portfolios = Portfolio::get(array('name','filter','images'));//указали поля которые нам нужно выбрать
        $services = Service::where('id','<',20)->get();//выберам все поля с условием не более 20 айди
        $peoples = People::take(3)->get();//выбераме 3 сторудника
        
        //Выбираем только уникальные значения поля filter таблички portfolios
        $tags = DB::table('portfolios')->distinct()->lists('filter');
        
        //dd($tags);
        
        //инициализируем переменную-массив для сбора пунктов меню
        $menu = array();
        
        //Добавляем динамические пункты меню из БД
        foreach($pages as $page){
            
            $item = array('title' => $page->name, 'alias' => $page->alias);
            array_push($menu,$item);
        }
        
        //Добавляем статические пункты меню в переменную $menu
        $item = array('title' => 'Services', 'alias' => 'service');//alias == html id
        array_push($menu,$item);
        
        $item = array('title' => 'Portfolio', 'alias' => 'Portfolio');
        array_push($menu, $item);
        
//        $item = array('title' => 'Clients', 'alias' => 'clients' );
//        array_push($menu, $item);
        
        $item = array('title' => 'Team', 'alias' => 'team');
        array_push($menu,$item);
        
        $item = array('title' => 'Contact', 'alias' => 'contact');
        array_push($menu, $item);
        
        
        //dd($menu);
        //return view('layouts.site');//указываем, что наше представление site находится в папке layouts
        return view('site.index', array('menu'       => $menu, 
                                        'pages'      => $pages,
                                        'services'   => $services, 
                                        'portfolios' => $portfolios,
                                        'peoples'    => $peoples,
                                        'tags'       => $tags,
                                        ));//указываем, что наше представление 
                                        //index находится в папке site 
                                        //и передаем пеерменные исспльзуемые
                                        // для вывода информации на экран

    }
}
