<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller{
    
    public function before()
    {
        //auth check
        if(!Auth::instance()->logged_in())
        {
            $this->redirect('login', 303);
        }
    }
    
    public function action_index()
    {
        $view = View::factory('common/template');
        $view->title = 'Football Management System';
        
        $view->body = View::factory('index');
        $view->body->info = 'Home';
        
        $this->response->body($view->render());
    }
    
}