<?php

chdir(__DIR__);

/**
 * Class Base
 * @package markdown\libray
 */


/**
 * Class Base
 * @package markdown\library
 */
abstract class Base
{


  /**
   * @var array|mixed
   */
  protected $configs = [];

  /**
   *
   * Base constructor.
   */
  public function __construct ()
  {
    chdir(__DIR__);
    if (!is_file("../config/config.php"))
      throw new Exception('Config file does not exist');

    $configs = include '../config/config.php';

    if (empty($configs))
      throw new Exception('No configs available');


    /**
     * Config to global variable
     */
    $this->configs = $configs;
  }


  /**
   * @param null $key
   * @return array|mixed
   */
  public function getConfigs ($key = null)
  {
    if ($key && isset($this->configs[$key]))
      return $this->configs[$key];

    return $this->configs;
  }

}