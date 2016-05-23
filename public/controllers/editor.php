<?php
chdir(__DIR__);

include_once('base.php');
include_once('../../library/editor.php');

class editor extends BaseController
{

  public function save ()
  {
    $documentID = $this->getRequestData('document-id');
    $editor = new EditorClass();

    //update
    if ($documentID)
      $editor->update($documentID, $this->getRequestData());
    else //create new
    {
      $documentID = $editor->createEditor($this->getRequestData());
    }

    $this->getJson([
      'documentID' => $documentID
    ]);

    return;
  }

  public function generate ()
  {
    $documentID = $this->getRequestData('document-id');
    $code = $this->getRequestData('code');
    $editor = new EditorClass();
    $data = $editor->parseMarkDown($documentID, $code);
    $this->getJson($data);
  }

  public function deleteDocument ()
  {

    $documentID = $this->getRequestData('document-id');


    $editor = new EditorModel();
    $editor->update($documentID, ['delete' => 1]);


  }
}