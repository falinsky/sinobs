<?php

class FileLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType){
        if(($eventType == App::EVENT_LOGIN_FAILURE) && ($observable instanceof App)){
            $log = new KLogger("log", KLogger::DEBUG);
            $log->logInfo("Wrong pair login/pass with login \"LOGIN\"");
        }
    }
}
