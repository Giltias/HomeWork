<?php

namespace Models;


/**
 * Class AutoTransmission
 * @package Models
 */
class AutoTransmission extends Transmission
{
    /**
     * AutoTransmission constructor.
     */
    public function __construct()
    {
        $this->gears = array_merge($this->gears, ['вперед', 'назад']);
        $this->state = 0;
    }

    /**
     * @param $direction
     * @param int $speed
     * @return mixed|void
     */
    function shiftGear($direction, $speed = 0)
    {
        ($direction === 'вперед')
            ? $this->state = 1
            : $this->state = 2;

        echo $this->checkState();
    }

    /**
     * @return string
     */
    function checkState()
    {
        return $this->printState($this->state, 1);
    }
}