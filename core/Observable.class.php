<?php

class Observable implements IObservable
{
    const EVENT_LOGIN_SUCCESS = 1;
    const EVENT_LOGIN_FAILURE = 2;

    private static $_instance = null;
    private $_observers = array(array());

    private function __construct(){}

    private function __clone(){}

    private function __wakeup(){}

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Observable();
        }
        return self::$_instance;
    }

    public function addObserver(IObserver $observer, $eventType){
        $this->_observers[$eventType][] = $observer;
    }

    public function notify($eventType){
        foreach($this->_observers[$eventType] as $observer){
            $observer->notify($this,$eventType);
        }
    }
}
