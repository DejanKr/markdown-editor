<?php

chdir(__DIR__);

include_once("baseModel.php");

class UserModel extends BaseModel
{


    protected $tableName = 'users';
    protected $primary = 'UserID';
    protected $fillable = [
        'Username', 'Password', 'LastInsert'
    ];

    protected $fieldMap = [
        'username' => 'UserName',
        'password' => 'Password'


    ];

    public function update($id, $data)
    {

        $dataToUpdate = [];
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->fieldMap))
                $dataToUpdate[$this->fieldMap[$key]] = $value;
        }


        return parent::update($id, $dataToUpdate);
        // TODO: Change the autogenerated stub
    }

    public function checkUser($request)
    {
       // var_dump($request);
        $params = [
            'Username' => $request['username']
            //'Password' => $this->request['password']
        ];
        $elt = $this->getAll($params);
       // var_dump($elt);

        if (!empty($elt))
        {
            if (password_verify($request['password'], $elt[0]['Password']))
            {
                $_SESSION['logged'] = 'yes';
                $_SESSION['username']=$request['username'];
                
                
            }
            else
            {
                //var_dump("jee");
                $_SESSION['logged'] = 'no';
            }

        }
        else
        {
            //var_dump("jee");
            $_SESSION['logged'] = 'no';
        }
        //header("Refresh:0; url=index.php");
        header("location:index.php");
        //var_dump("tuki je štos");


    }
    public function existUser($request)
    {
        


    }


}