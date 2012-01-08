<?php

abstract class BaseApplication extends Observable
{
    abstract public function actionIndex($params);

    public function run(){
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
        echo 404;
    }

}
