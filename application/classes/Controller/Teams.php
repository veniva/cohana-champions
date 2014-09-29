<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Teams extends Controller{
    
    /**
     * @var Model_Teams
     */
    private $model;
    
    public function before()
    {
        //auth check
        if(!Auth::instance()->logged_in())
        {
            $this->redirect('login', 303);
        }
        $this->model = Model::factory('Teams');
    }
    
    public function action_index()
    {
        $view = View::factory('common/template');
        $view->body = View::factory('teams');
        $view->title = $view->body->title = 'Manage Teams';
        
        $view->body->list = $this->model->get_teams();
        
        $this->response->body($view->render());
    }
    
    public function action_insert()
    {
        $id = $this->request->param('id', false);
        
        $view = View::factory('common/template');
        $view->body = View::factory('teams_form');
        $view->title = $view->body->title = $id ? 'Update Team' : 'Insert Team';
        
        $errors = '';
        $team = array('name' => '');
        
        if($id)
        {
            $team = $this->model->get_team($id);
        }
        
        if($this->request->post())
        {
            //validation rules
            $validation = Validation::factory($this->request->post())
                ->rule('name', 'not_empty');

            if($validation->check())
            {
                $this->model->insert_team($this->request->post(), $id);
                $this->redirect('teams', 303);
            }

            foreach($validation->errors() as $error)
            {
                if(reset($error) == 'not_empty')
                {
                    $errors = 'All the fields are mandatory';
                    break;
                }
            }

            //update the info with the post
            $team = $this->request->post();
        }
        
        $view->body->team = $team;
        $view->body->errors = $errors;
        
        $this->response->body($view->render());
    }
    
    public function action_delete()
    {
        $id_team = $this->request->param('id', false);
        if($id_team)
        {
            $this->model->delete_team($id_team);
        }
        $this->redirect('teams', 303);
    }
}