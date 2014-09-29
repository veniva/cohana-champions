<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Players extends Controller{
    
    /**
     * @var Model_Players
     */
    private $model;
    
    public function before()
    {
        //auth check
        if(!Auth::instance()->logged_in())
        {
            $this->redirect('login', 303);
        }
        
        $this->model = Model::factory('Players');
    }
    
    public function action_index()
    {
        $view = View::factory('common/template');
        $view->body = View::factory('players');
        $view->title = $view->body->title = 'Manage Players';
        
        $view->body->list = $this->model->get_players();
        
        $this->response->body($view->render());
    }
    
    /**
     * Update / Insert players
     */
    public function action_insert()
    {
        $id = $this->request->param('id', false);
        $modelTeams = Model::factory('Teams');
        
        $view = View::factory('common/template');
        $view->body = View::factory('players_form');
        $view->title = $view->body->title = $id ? 'Update Player' : 'Insert Player';
        
        $errors = '';
        $player = array('name' => '', 'family' => '', 'id_team' => '');
        
        if($id)
        {
            $player = $this->model->get_player($id);
        }
        
        if($this->request->post())
        {
            //validation rules
            $validation = Validation::factory($this->request->post())
                ->rule('name', 'not_empty')
                ->rule('family', 'not_empty');

            if($validation->check())
            {
                $this->model->insert_player($this->request->post(), $id);
                $this->redirect('players', 303);
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
            $player = $this->request->post();
        }
        
        $view->body->player = $player;
        
        $options = $modelTeams->teams_as_options();
        $view->body->teams = $options;
        $view->body->errors = $errors;
        
        $this->response->body($view->render());
    }
    
    public function action_delete()
    {
        $id_player = $this->request->param('id', false);
        if($id_player)
        {
            $this->model->delete_player($id_player);
        }
        $this->redirect('players', 303);
    }
}