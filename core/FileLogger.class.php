<?php

class FileLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType){
        if($observable instanceof Observable){
            $log = new KLogger("log", KLogger::DEBUG);
            if($eventType == Observable::EVENT_LOGIN_FAILURE){
                $log->logInfo("Wrong pair login/pass with login \"LOGIN\"");
            } elseif($eventType == Observable::EVENT_LOGIN_SUCCESS){
                $log->logInfo("Success login of user \"LOGIN\"");
            }
        }
    }
}
