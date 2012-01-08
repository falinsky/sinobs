<?php

interface IObserver
{
    public function notify(IObservable $observable, $eventType, $data);
}
