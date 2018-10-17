<?php

namespace App\Http\Controllers\Client;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class SiteController extends Controller
{
    protected $menus;

    public function __construct()
    {
        $this->menus = Menu::orderBy('order', 'asc')->get();  
        $this->menus = $this->buildMenu($this->menus); 
    }

    public function showMainPage()
    {
        $page = Page::where('is_main', 1)->first();
        $menus = $this->menus;
        dd($menus);
        return view('client.page.show', compact('page','menus'));
    }
}
