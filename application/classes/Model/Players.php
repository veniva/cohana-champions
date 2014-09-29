<?php defined('SYSPATH') or die('No direct script access.');

class Model_Players extends Model{
    
    public function get_players()
    {
        //get the players' list
        $query = DB::query(Database::SELECT, "
            SELECT p.*, IF(t.name IS NOT NULL, t.name, '---') as team_name 
            FROM players p
            LEFT JOIN players_teams pt ON pt.id_player = p.id
            LEFT JOIN teams t ON t.id = pt.id_team
            ORDER BY p.id
        ");
        return $query->execute();
    }
    
    /**
     * Returns the name and surname of the player, and the ID of it's team
     * @param int $id
     * @return array
     */
    public function get_player($id)
    {
        $query = DB::query(Database::SELECT, "
            SELECT p.*, pt.id_team
            FROM players p
            LEFT JOIN players_teams pt ON pt.id_player = p.id
            WHERE p.id = :id
        ");
        $query->param(':id', $id);
        $data = $query->execute();
        $data = $data->as_array();
        return reset($data);
    }
    
    public function insert_player($data, $id_player = false)
    {
        $player = $data;
        unset($player['id_team']);//to be compatible with the table columns
        
        if(!$id_player)
        {//insert 
            $result = DB::insert('players', array_keys($player))->values($player)->execute();
            $id_player = reset($result);
        }
        else
        {//update
            DB::update('players')->set($player)->where('id', '=', $id_player)->execute();
            DB::delete('players_teams')->where('id_player', '=', $id_player)->execute();
        }
        
        if(!empty($data['id_team']))
        {
            DB::insert('players_teams', array('id_player', 'id_team'))->values(array($id_player, $data['id_team']))->execute();
        }
    }
    
    public function delete_player($id_player)
    {
        DB::delete('players')->where('id', '=', $id_player)->execute();
    }
}