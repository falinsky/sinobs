<?php

abstract class BaseApplication
{
    abstract public function actionIndex($params=null);

    public function preRun(){

    }

    public function run(){
        $this->preRun();
        session_start();
        $action = (isset($_REQUEST["action"]) && (strlen($_REQUEST["action"])>0)) ? $_REQUEST["action"] : null;
        $params = isset($_REQUEST["params"]) ? array($_REQUEST["params"]) : array();
        if(!is_null($action)){
            if(method_exists($this,"action".ucfirst($action))) {
                call_user_func_array(array($this,"action".ucfirst($action)),$params);
            }
            else {
                $this->action404();
            }
        } else {
            call_user_func_array(array($this,'actionIndex'),$params);
        }
    }

    public function action404(){
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

}
