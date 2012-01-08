<?php

class FileLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType){
        $log = new KLogger("log", KLogger::DEBUG);
        $log->logInfo("Wrong pair login/pass with login \"LOGIN\"");
    }
}
