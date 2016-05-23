<?php
include_once('base.php');
include_once('/../../library/editor.php');


class index extends BaseController
{

  public $element;

  public function __construct ($controller, $request)
  {

    $controller = 'index';
    parent::__construct($controller, $request);
  }


  public function index ()
  {
    $data = $this->request;
    $this->action = 'index';


    $edi = new EditorModel();


    $data['element'] = (isset($this->request['document-id'])) ? $edi->find($this->request['document-id']) : null;
    return $this->getView($data);


  }

  public function showList ()
  {

    $this->action = "showList";
    $editor = new EditorClass();
    $listOfDocuments = $editor->getListOfDocuments();
    return $this->getView([
      'DocumentList' => $listOfDocuments
    ]);
  }


}

