<?php

chdir(__DIR__);

include_once("intefraces/baseInterface.php");


abstract class BaseModel implements BaseInterface
{
  protected $tableName = '';
  protected $fillable = [];
  protected $primary = '';


  /**
   * @var array
   */
  private $configs = [];

  /**
   * @var PDO
   */
  private $db = null;

  /**
   *
   * Base constructor.
   */
  public function __construct ()
  {
    chdir(__DIR__);

    if (!is_file("../../config/config.php"))
      throw new Exception('Config file does not exist');

    $configs = include '../../config/config.php';

    if (empty($configs))
      throw new Exception('No configs available');

    if (!isset($configs['db']))
      throw new Exception('No database configs available');

    /**
     * Config to global variable
     */

    $this->configs = $configs;
    $this->initDatabase();
  }

  protected function createInsert ()
  {
    $string = "";
    $columns = implode(',', $this->fillable);

    $string .= "(" . $columns . ")";
    $string .= "VALUES (";
    $count = 0;

    foreach ($this->fillable as $fill) {
      $string .= 'NULL';

      if (++ $count < sizeof($this->fillable))
        $string .= ', ';
    }
    $string .= ");";

    return $string;
  }

  /**
   * @return PDO
   */
  protected function getDatabase ()
  {
    return $this->db;
  }


  protected function initDatabase ()
  {

    $dbConfigs = $this->getConfigs('db');

    if (!isset($dbConfigs['host']) || !isset($dbConfigs['dbname']) ||
      !isset($dbConfigs['user']) || !isset($dbConfigs['password'])
    )
      throw new Exception('No 1 database configs available');

    try {

      $string = 'mysql:host=%s;dbname=%s';
      $dsn = sprintf($string, $dbConfigs['host'], $dbConfigs['dbname']);

      $db = new PDO($dsn, $dbConfigs['user'], $dbConfigs['password']);
      $this->db = $db;

    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /**
   * @param null $key
   * @return array|mixed
   */
  protected function getConfigs ($key = null)
  {

    if ($key && isset($this->configs[$key]))
      return $this->configs[$key];

    return $this->configs;
  }

  /**
   * @inheritDoc
   */
  public function create ()
  {
    $sql = "INSERT INTO {$this->tableName} {$this->createInsert()}";
    
    $db = $this->getDatabase();
    $handle = $db->prepare($sql);

    $handle->execute();
    return $db->lastInsertId();
  }

  /**
   * @inheritDoc
   */

/*
  public function existMember($username,$password)
  {
    $db=$this->getDatabase();
    $handle=$db->prepare("SELECT * FROM {$this->tableName} WHERE {$}")

  }
*/
  public function find ($id)
  {
    $db = $this->getDatabase();
    $handle = $db->prepare("SELECT * FROM {$this->tableName} WHERE {$this->primary} = :id");
    $handle->execute([
      ':id' => $id
    ]);
    return $handle->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * @inheritDoc
   */
  
  public function update ($id, $data)
  {

    $sql = "UPDATE {$this->tableName} ";

    $sql .= "SET";

    if ($this->hasLastUpdate())
      $data['LastUpdate'] = (new DateTime('now'))->format('Y-m-d h:s');

    foreach ($data as $key => $value) {
      $sql .= " {$key} = :{$key}, ";

    }

    $sql = substr($sql, 0, strlen($sql) - 2);

    $sql .= " WHERE {$this->primary} = :id";


    $db = $this->getDatabase();
    //var_dump($sql);
    //exit;
    $handler = $db->prepare($sql);

    $params = [];

    foreach ($data as $key => $value)
      $params[':' . $key] = $value;

    $params[':id'] = $id;

    return $handler->execute($params);
  }


  protected function hasLastUpdate ()
  {
    return in_array('LastUpdate', $this->fillable);
  }

  /**
   * @inheritDoc
   */
  public function delete ($id)
  {

  }

  public function save ()
  {

  }

  public function getAll ($params = [])
  {
    $db = $this->getDatabase();
    $where = "";

    if (!empty($params)) {
      $where .= "WHERE ";
      foreach ($params as $param => $item) {
        if ($item == "IS NOT NULL") {
          $where = $where . "`" . $param . "`" . "!='NULL' AND";
          $where .= " ";
        }
        else if ($item == 'IS NULL') {
          $where = $where . "`" . $param . "`" . " ='NULL' AND";
          $where .= " ";
        }
        else {
          $where = $where . "`" . $param . "`" . " ='" . $item . "' AND";
          $where .= " ";
        }
      }
    }

    if ($where == "WHERE") {
      $where = "";
    }
    else {
      $where = substr($where, 0, strlen($where) - 4);
    }
    $handler = $db->prepare("SELECT * FROM editor.{$this->tableName} $where ORDER BY {$this->primary} DESC");
    $handler->execute();
    return $handler->fetchAll(PDO::FETCH_ASSOC);


  }

}