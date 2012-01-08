<?php

class FileLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType, $data){
        if($observable instanceof Observable){
            $log = new KLogger("log", KLogger::DEBUG);
            if($eventType == Observable::EVENT_LOGIN_FAILURE){
                $log->logInfo("Wrong pair login/pass with login \"".$data["login"]."\"");
            } elseif($eventType == Observable::EVENT_LOGIN_SUCCESS){
                var_dump($data);
                $log->logInfo("Success login of user \"".$data["login"]."\"");
            }
        }
    }
}
