<?php
chdir(__DIR__);
include_once('base.php');
include_once('model/editor.php');
include_once('../../vendor/cebe/markdown/GithubMarkdown.php');

//chdir(__DIR__);
class EditorClass extends Base
{
  public function createEditor ($data)
  {
    //double check
    // create and insert
    //return false

    $editor = new EditorModel();
    //var_dump($editor);
    $documentID = $editor->create();
    $editor->update($documentID, $data);
    return $documentID;
  }

  public function update ($documentID, $data)
  {
    $editor = new EditorModel();
    return $editor->update($documentID, $data);
  }

  public function getConfig ()
  {
    return $this->configs;
  }

  public function save ()
  {

  }

  public function getListOfDocuments ()
  {

    $editor = new EditorModel();
    $params = [
      'Alias' => 'IS NOT NULL'
    ];

    return $editor->getAll($params);
  }

  public function show ($documentID)
  {
    $editor = new EditorModel();
    return $editor->find($documentID);

  }

  public function parseMarkDown ($documentID, $code = null)
  {
    if (!$documentID)
      return
        [
          'status' => 'error',
          'message' => 'Document ID not sent'
        ];

    $code = $code ?: $this->getCodeFromID($documentID);

    return [
      'status' => 'success',
      'html' => $this->getCompiledCode($code)
    ];
  }


  function getCodeFromID ($documentID)
  {
    $editor = new EditorModel();

    $currentEditor = $editor->find($documentID);
    return $currentEditor['Text'];
  }

  private function getCompiledCode ($code)
  {
    $parser = new \cebe\markdown\GithubMarkdown();
    return $parser->parse($code);
  }
}






