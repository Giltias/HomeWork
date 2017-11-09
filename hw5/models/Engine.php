<?php

namespace Models;


/**
 * Class Engine
 * @package Models
 */
class Engine
{
    /**
     * @var int
     */
    private $horsepower;
    /**
     * @var int
     */
    private $temperature;
    /**
     * @var mixed
     */
    private $maxTemp;
    /**
     * @var mixed
     */
    private $stepIncTemp;
    /**
     * @var mixed
     */
    private $stepCooling;
    /**
     * @var int
     */
    private $state;
    /**
     * @var mixed
     */
    private $tempIncDistance;

    /**
     *
     */
    const ENGINE_ON = 1;
    /**
     *
     */
    const ENGINE_OFF = 2;

    /**
     * Engine constructor.
     * @param int $power
     * @param array $data
     */
    public function __construct(int $power, $data = ['maxTemp' => 90, 'stepIncTemp' => 5, 'stepCooling' => 10, 'tempIncDistance' => 10])
    {
        $this->horsepower = $power;
        $this->temperature = 0;
        $this->maxTemp = $data['maxTemp'];
        $this->stepIncTemp = $data['stepIncTemp'];
        $this->stepCooling = $data['stepCooling'];
        $this->tempIncDistance = $data['tempIncDistance'];
        $this->state = self::ENGINE_OFF;
    }

    /**
     * @return int
     */
    public function getHorsepower(): int
    {
        return $this->horsepower;
    }

    /**
     * @param int $horsepower
     */
    public function setHorsepower(int $horsepower)
    {
        $this->horsepower = $horsepower;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature(float $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int
     */
    public function getMaxSpeed()
    {
        return $this->getHorsepower() * 2;
    }

    /**
     * @param int $speed
     * @return bool
     */
    public function checkMaxSpeed(int $speed)
    {
        return $this->getMaxSpeed() < $speed ? false : true;
    }

    /**
     * @return bool
     */
    public function checkOverheat()
    {
        return $this->temperature >= $this->maxTemp ? true : false;
    }

    /**
     * @param $speed
     * @return string
     */
    public function tempIncrease($speed)
    {
        $text = '';
        $this->setTemperature($this->getTemperature() + $this->stepIncTemp * (float)($speed / $this->tempIncDistance));
        if ($this->checkOverheat()) {
            $this->setTemperature($this->getTemperature() - $this->stepCooling);
            if ((float)$this->maxTemp !== (float)$this->getTemperature()) {
                $text = ' и охладилась до ' . $this->getTemperature();
            }
            return 'Температура повысилась до ' . $this->maxTemp . $text . '<br>';
        }
        return 'Температура повышается до ' . $this->getTemperature() . ' градусов.<br>';
    }

    /**
     * @return string
     */
    public function engineCooling()
    {
        $this->setTemperature($this->getTemperature() - $this->stepCooling);
        return 'Вентилятор остужает двигатель до ' . $this->getTemperature() . ' градусов.<br>';
    }

    /**
     * @param $speed
     * @return string
     */
    public function checkDistance($speed)
    {
        if ($this->checkOverheat()) {
            return $this->engineCooling();
        }

        return $this->tempIncrease($speed);

    }

    /**
     *
     */
    public function start()
    {
        $this->state = self::ENGINE_ON;
        $this->distTraveled = 0;
        echo 'Включили двигатель<br>';
    }

    /**
     *
     */
    public function stop()
    {
        $this->state = self::ENGINE_OFF;
        echo 'Выключили двигатель<br>';
    }


}