<?php

namespace Models;


/**
 * Class Car
 * @package Models
 */
class Car
{
    /**
     * @var
     */
    private $carModel;
    /**
     * @var Engine
     */
    private $engine;
    /**
     * @var Transmission
     */
    private $transmission;

    /**
     * Car constructor.
     * @param $power
     * @param $transmission
     * @param $carModel
     */
    public function __construct($power, $transmission, $carModel)
    {
        $this->carModel = $carModel;
        $this->engine = new Engine($power);
        ($transmission === 'Автоматическая')
            ? $this->transmission = new AutoTransmission()
            : $this->transmission = new ManualTransmission();
    }

    /**
     * @param $distance
     * @param $speed
     * @param $direction
     */
    public function move($distance, $speed, $direction)
    {
        $this->initialMessage();
        $this->engine->start();
        $this->transmission->shiftGear($direction, $speed);
        $this->eachSecondStatus($distance, $speed);
        $this->transmission->transmissionOff();
        $this->engine->stop();
    }

    /**
     * @param $distance
     * @param $speed
     */
    public function eachSecondStatus($distance, $speed)
    {
        $moveDistance = 0;
        while ($distance > $moveDistance) {
            $moveDistance += $speed;
            if ($moveDistance > $distance) {
                $speed -= ($moveDistance - $distance);
                $moveDistance = $distance;
            }
            echo '..........Проехали ' . $moveDistance . ' метров. ';
            echo $this->engine->checkDistance($speed);
        }
    }

    /**
     *
     */
    public function initialMessage()
    {
        echo '<b>Для автомобиля <u>' . $this->carModel . '</u> построен маршрут</b><br>';
    }
}