<?php

class PostgresDB {
    protected $db;

    public function __construct($dbname, $user, $pass) {
        $this->db = pg_connect("host=postgresql port=5432 dbname=$dbname user=$user password=$pass");
    }
    
    public function __destruct() {
        pg_close($this->db);
    }

    public function query($query) {
        $result = pg_query($this->db, $query);

        if ($result) {
            $row = pg_fetch_row($result);
            return $row;
        }

        throw new Exception(pg_last_error($this->db));
    }

    public function createScore($user_id) {
        $query = 'INSERT INTO cashe (user_id, score_user) VALUES (' . $user_id . ', 0.0)'; 
        
        if (!$this->getScore($user_id)) {
            $this->query($query);
        }
    }

    public function getScore($user_id) {
        $query = 'SELECT score_user FROM cashe WHERE user_id = '. $user_id;
        return $this->query($query)[0];
    }

    public function updateScore($user_id, $score) {
        if ($score < 0) {
          $query = 'UPDATE cashe SET score_user = CASE WHEN CAST('. 'ABS('.$score.')' .' AS money) < score_user THEN score_user + CAST(' . $score . ' AS money) ELSE score_user END WHERE user_id = ' . $user_id;
          $this->query($query);
          return;
        }

        $query = 'UPDATE cashe SET score_user = score_user + CAST(' . $score . ' AS money) WHERE user_id = '. $user_id;
        $this->query($query);
    }
}