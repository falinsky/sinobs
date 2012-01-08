<?php

abstract class Observable implements IObservable
{
    private $_observers = array(array());

    public function addObserver(IObserver $observer, $eventType){
        $this->_observers[$eventType][] = $observer;
    }

    public function notify($eventType){
        foreach($this->_observers[$eventType] as $observer){
            $observer->notify($this,$eventType);
        }
    }
}
