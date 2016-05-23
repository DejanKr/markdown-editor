<?php

/**
 * Interface BaseInterface
 */
interface BaseInterface
{
  /**
   * Creates new row in your database
   * @return mixed
   */
  public function create ();

  /**
   * Reads data from database
   * @param $id
   * @return mixed
   */
  public function find ($id);

  /**
   * @param $id
   * @param $data
   * @return mixed
   */
  public function update ($id, $data);

  /**
   * @param $id
   * @return mixed
   */
  public function delete ($id);

  /**
   * @return mixed
   */
  public function save ();
}