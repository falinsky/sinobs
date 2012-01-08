<?php

class DbLogger implements IObserver
{
    public function notify(IObservable $observable, $eventType, $data){
        if(($observable instanceof Observable) && ($eventType == Observable::EVENT_LOGIN_SUCCESS)){
            $db = Db::getInstance();
            $db->prepare("INSERT INTO user_logins (user_id) values (?)")->execute(array($data["id"]));
        }
    }
}
