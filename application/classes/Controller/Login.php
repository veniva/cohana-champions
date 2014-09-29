<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller{
    
    public function action_index()
    {
        $view = View::factory('login');
        $view->error = '';
        // Handled from a form with inputs with names email / password
        
        if($this->request->post())
        {
            $post = $this->request->post();
            $success = Auth::instance()->login($post['username'], $post['password']);

            if ($success)
            {
                $this->redirect('index', 303);
            }
            else
            {
                $view->error = 'Wrong login. Please try again';
            }
        }

        $this->response->body($view->render());
    }
    
    public function action_logout()
    {
        Auth::instance()->logout();
        $this->redirect('login', 303);
    }
}