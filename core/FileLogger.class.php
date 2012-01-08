<?php

class FileLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType){
        if(($eventType == Observable::EVENT_LOGIN_FAILURE) && ($observable instanceof Observable)){
            $log = new KLogger("log", KLogger::DEBUG);
            $log->logInfo("Wrong pair login/pass with login \"LOGIN\"");
        }
    }
}
