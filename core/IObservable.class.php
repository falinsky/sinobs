<?php

interface IObservable
{
    public function addObserver(IObserver $observer, $eventType);
    public function notify($eventType, $data);
}