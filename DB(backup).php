<?php
/**
 * Class DB
 * работа с базой данных
 */

class DB
{
  private $source;

  function connect()
  {
    global $config;

    if(!is_null($this->source))
      return true;

    $this->source = mysql_connect($config['db']['host'], $config['db']['user'], $config['db']['pass']);
    if(!$this->source)
    {
      die('Could not connect: ' . mysql_error());
    }

    if(!mysql_select_db($config['db']['db'], $this->source))
    {
      die('Could not select: ' . mysql_error());
    }

    $this->q("SET NAMES 'utf8'");
    $this->q('SET collation_connection = "utf8_general_ci"');

    return true;
  }

  function q($query)
  {
    return mysql_query($query, $this->source);
  }

  function select($query)
  {
    $res = $this->q($query);

    if(!$res)
      return null;

    $result = array();
    while(($r = mysql_fetch_assoc($res)) !== false)
    {
      $result[] = $r;
    }

    return $result;
  }
} 