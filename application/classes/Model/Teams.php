<?php defined('SYSPATH') or die('No direct script access.');

class Model_Teams extends Model{
    
    public function get_teams()
    {
        return DB::select()->from('teams')->execute();
    }
    
    public function get_team($id)
    {
        $query = DB::select()->from('teams')->where('id', '=', $id);
        $result = $query->execute()->as_array();
        return reset($result);
    }
    
    public function insert_team($data, $id_team = false)
    {
        if(!$id_team)
        {
            DB::insert('teams', array_keys($data))->values($data)->execute();
        }
        else
        {
            DB::update('teams')->set($data)->where('id', '=', $id_team)->execute();
        }
    }
    
    public function delete_team($id_team)
    {
        //get all the players in that team
        $players_teams = DB::select()->from('players_teams')->where('id_team', '=', $id_team)->execute();
        $player_ids = array();
        foreach($players_teams as $player_to_team)
        {
            $player_ids[] = $player_to_team['id_player'];
        }
        
        DB::delete('teams')->where('id', '=', $id_team)->execute();
        DB::delete('players')->where('id', 'IN', $player_ids)->execute();
    }
    
    public function teams_as_options(){
        $options = array('-- None --');
        foreach($this->get_teams() as $team)
        {
            $options[$team['id']] = $team['name'];
        }
        return $options;
    }
}