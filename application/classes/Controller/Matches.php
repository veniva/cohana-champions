<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Matches extends Controller{
    
    /**
     * @var Model_Matches 
     */
    private $model;
    
    public function before()
    {
        //auth check
        if(!Auth::instance()->logged_in())
        {
            $this->redirect('login', 303);
        }
        //get the matches' list
        $this->model = Model::factory('Matches');
    }
    
    public function action_index()
    {
        $view = View::factory('common/template');
        $view->body = View::factory('matches');
        $view->title = $view->body->title = 'Manage Matches';
        
        $view->body->list = $this->model->get_matches();
        
        $this->response->body($view->render());
    }
    
    public function action_insert()
    {
        $id = $this->request->param('id', false);
        $modelTeams = Model::factory('Teams');
        
        $view = View::factory('common/template');
        $view->body = View::factory('matches_form');
        $view->title = $view->body->title = $id ? 'Update Match' : 'Appoint Match';
        
        $match = array('id_team1' => '', 'id_team2' => '', 'date' => '');
        
        if($id)
        {
            $match = $this->model->get_match($id);
        }
        
        $error = '';
        $ids_matches = array();
        if($this->request->post())
        {
            //validation 
            if(empty($_POST['id_team1']) OR empty($_POST['id_team2']) OR empty($_POST['date']))
            {
                $error .= 'All the fields are mandatory\n';
            }
            if(strtotime($_POST['date']) === false)
            {
                $error .= 'You must enter date in format: DD-MM-YYYY\n';
            }
            elseif(strtotime($_POST['date']) < strtotime(date('Y-m-d')))
            {
                $error .= 'You have chosen date in the past\n';
            }
            if($_POST['id_team1'] == $_POST['id_team2'])
            {
                $error .= 'You have selected two equal teams\n';
            }
            if($this->model->check_matches_dates($_POST['date'], $_POST['id_team1'], $_POST['id_team2'], $ids_matches))
            {
                if(!$id OR ( $id AND (!in_array($id, $ids_matches)) ) ){//if we edit, then don't take this same match into account for this error
                    $error .= 'There is already a match appointed for that date with some of those teams participating in it.\nPlease select another date';
                }
            }
            
            if(empty($error))
            {
                $this->model->insert_match($this->request->post(), $id);
                $this->redirect('matches', 303);
            }
            
            //update the info with the post data
            $match = $this->request->post();
        }
        
        $view->body->match = $match;
        $view->body->team_options = $modelTeams->teams_as_options();
        $view->body->error = $error;
        
        $this->response->body($view->render());
    }
    
    public function action_delete()
    {
        $id = $this->request->param('id', false);
        if($id)
        {
            $this->model->delete_match($id);
        }
        $this->redirect('matches', 303);
    }
}