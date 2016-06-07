<?php


class BaseController
{
    /**
     * @var array
     */

    protected $request = [];
    protected $controller = '';
    protected $action = '';

    public function __construct($controller, $request)
    {
        $this->request = $request;
        $this->controller = $controller;

    }

    /*
     * Controller function to get view.
     */
    protected function getView($data = [])
    {

        if ($data && sizeof($data) > 0 && is_array($data)) {
            foreach ($data as $key => $value)
                $this->$key = $value;
        }
        unset($data);
        return include __DIR__ . '/../views/' . $this->controller . "/" . $this->action . '.phtml';

    }

    /*
     * Controller function JSON encode.
     */
    protected function getJson($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
    /*
     * Controller function to get request data. 
     */
    protected function getRequestData($key = null, $default = null)
    {
        $request = $this->request;

        if ($key && is_array($request))
            if (isset($request[$key]))
                return $request[$key];

            else
                return $default;

        return $request;
    }
}