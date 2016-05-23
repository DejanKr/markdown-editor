<?php
chdir(__DIR__);
include_once ('base.php');
include_once('model/user.php');
//include '../../vendor/cebe/markdown/GithubMarkdown.php';

//chdir(__DIR__);
class UserClass extends Base
{
    public function createUser ($data)
    {
        //double check
        // create and insert
        //return false

        $editor = new UserModel();
        //var_dump($editor);
        /*
        $documentID = $editor->create();
        $editor->update($documentID, $data);
        return $documentID;
        */
    }

    public function update ($documentID, $data)
    {
        $user = new UserModel();
        return $user->update($documentID, $data);
    }

    public function getConfig ()
    {
        return $this->configs;
    }

    public function save ()
    {

    }

    public function getUser ($params)
    {

        $user = new UserModel();
        $back=$user->getAll($params);
        return $back;
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






