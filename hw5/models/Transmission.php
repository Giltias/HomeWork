<?php

namespace Models;


/**
 * Class Transmission
 * @package Models
 */
abstract class Transmission
{
    /**
     * @var array
     */
    protected $gears = ['нейтральная'];
    /**
     * @var int
     */
    protected $state = 0;

    /**
     * @param $direction
     * @param int $speed
     * @return mixed
     */
    abstract function shiftGear($direction, $speed = 0);

    /**
     * @return mixed
     */
    abstract function checkState();

    /**
     * @param $index
     * @param int $mode
     * @return string
     */
    public function printState($index, $mode = 0)
    {
        $text = '.....';
        $text .= ($mode === 0 || $index === 0)
            ? 'Включена ' . $this->gears[$index] . ' передача'
            : 'Включен режим езды ' . $this->gears[$index];
        $text .= '<br>';
        return $text;
    }

    /**
     *
     */
    public function transmissionOff()
    {
        $this->state = 0;
        echo $this->printState($this->state) . '.....Машина остановлена<br>';
    }
}