<?php


class Post extends DB
{
  public $id = 0;
  public $params = array();

  public function __construct($id = 0)
  {
    $this->connect();

    $this->id = (int)$id;

    if($this->id > 0)
    {
      $this->params = $this->select('select * from post where id=' . $this->id);
      if(is_array($this->params))
        $this->params = $this->params[0];
    }
  }

  public function Add($params)
  {
    if($this->id != 0)
      return false;

    if(!$params['name'])
      return false;

    if(!$params['message'])
      return false;

    if($this->q("insert into post (name, date, message) values ('{$params['name']}', NOW(), '{$params['message']}')"))
      return true;

    return false;
  }

  public function Update($params)
  {
    if($this->id == 0)
      return false;

    if(!$params['name'])
      return false;

    if(!$params['message'])
      return false;

    if($this->q("update post set name = '{$params['name']}', message = '{$params['message']}' where id=" . $this->id))
      return true;

    return false;
  }

  /**
   * получить список постов
   * @param string $select
   * @param string $where
   * @param string $order
   * @param int $limit
   * @param int $offset
   * @return self[]
   */
  public function GetList($select = '*', $where = '', $order = '', $limit = 0, $offset = 0)
  {
    $return = array();
    $res = $this->select('select ' .
      $select . ' from post ' .
      ($where ? ' WHERE ' . $where : '') .
      ($order ? ' ORDER BY ' . $order : '') . ' ' .
      ($limit ? ' LIMIT ' . ($offset ? $offset . ', ' . $limit : $limit) : '') // LIMIT 10;  LIMIT 50, 10
    );

    if(!$res)
      return $return;

    foreach($res as $item)
    {
      $return[] = new self($item['id']);
    }

    return $return;
  }

  public function Delete($chkval)
  {
    //if($this->q("delete from post where id=" . $this->id))
    if($this->q("delete from post where id='$chkval'"))  
      return true;

    return false;
  }


  public function getArchive()
  {
    $monthNames = array(1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь');

    // получить все года и месяца, за которые есть посты
    $archiveList = $this->select('SELECT DATE_FORMAT(date, "%Y") year, DATE_FORMAT(date, "%c") month from post group by year, month ORDER BY year desc, month desc');
    if(!empty($archiveList))
    {
      foreach($archiveList as $k => $item)
      {
        $archiveList[$k]['month_name'] = $monthNames[$item['month']];
      }

    }
    return $archiveList;
  }
} 