<?php
/*
 * Class DB
 * работа с базой данных 
 * Избегать нескольких вызовов DB::connect() на странице
 */
class DB
{
    private $mysqli;
 
    function connect()
    {
        global $config;
        if (!is_null($this->mysqli))
            return true;
        $this->mysqli = @new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['db']);
        if (mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }
        $this->q("SET NAMES 'utf8'");
        $this->q('SET collation_connection = "utf8_general_ci"');
        return true;
    }
 
    function q($query)
    {
        return $this->mysqli->query($query);
    }
 
    function select($query)
    {
        $res = $this->q($query);
        if (!$res)
            return null;
        return $result = $res->fetch_all(MYSQLI_ASSOC);
    }
}

?>