<?php

namespace Models;


/**
 * Class ManualTransmission
 * @package Models
 */
class ManualTransmission extends Transmission
{
    /**
     * ManualTransmission constructor.
     */
    public function __construct()
    {
        $this->gears = array_merge($this->gears, ['первая', 'вторая', 'задняя']);
        $this->state = 0;
    }

    /**
     * @param $direction
     * @param int $speed
     * @return mixed|void
     */
    function shiftGear($direction, $speed = 0)
    {
        if ($direction === 'вперед') {
            ($speed > 0 && $speed <= 20)
                ? $this->state = 1
                : $this->state = 2;
        } else {
            $this->state = 3;
        }

        echo $this->checkState();
    }

    /**
     * @return string
     */
    function checkState()
    {
        return $this->printState($this->state);
    }

}