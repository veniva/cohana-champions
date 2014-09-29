<?php defined('SYSPATH') or die('No direct script access.');

class Model_Matches extends Model{
    
    public function get_matches()
    {
       //get the matches' list
        $query = DB::query(Database::SELECT, "
            SELECT m.*, t1.name AS team1, t2.name AS team2
            FROM matches m
            JOIN teams t1 ON t1.id = m.id_team1
            JOIN teams t2 ON t2.id = m.id_team2
        ");
        return $query->execute();
    }
    
    public function get_match($id)
    {
        $id = (int) $id;
        $query = DB::query(Database::SELECT, "
            SELECT m.*, t1.name AS team1, t2.name AS team2
            FROM matches m
            JOIN teams t1 ON t1.id = m.id_team1
            JOIN teams t2 ON t2.id = m.id_team2
            WHERE m.id = $id
        ");
        $result = $query->execute()->as_array();
        return reset($result);
    }
    
    public function insert_match($data, $id_match = false)
    {
        if(!$id_match)
        {
            DB::insert('matches', array_keys($data))->values($data)->execute();
        }
        else
        {
            DB::update('matches')->set($data)->where('id', '=', $id_match)->execute();
        }
    }
    
    /**
     * Checks if there are matches appointed for that particular date with some of the teams participating in it.
     * @param string $date
     * @param int $id_team1
     * @param int $id_team2
     * @param array $id_matches The reference variable to be populated with the ids of the matches appointed for that day
     * @return bool TRUE if there are matches with participation of any of that teams on that date, FALSE otherwise
     */
    public function check_matches_dates($date, $id_team1, $id_team2, &$id_matches = array())
    {
        $id_team1 = (int) $id_team1;
        $id_team2 = (int) $id_team2;
        $query = DB::query(Database::SELECT, "
            SELECT *
            FROM matches
            WHERE `date` = :date 
            AND ($id_team1 = id_team1 OR $id_team1 = id_team2 OR $id_team2 = id_team1 OR $id_team2 = id_team2)
            GROUP BY id
        ");
        $query->bind(':date', $date);
        $result = $query->execute()->as_array();
        if(!empty($result))
        {
            foreach($result as $rows)
            {
                $id_matches[] = $rows['id'];
            }
        }
        return !empty($result);
    }
    
    public function delete_match($id)
    {
        DB::delete('matches')->where('id', '=', $id)->execute();
    }
}