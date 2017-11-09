<?php

namespace Models;


/**
 * Class Niva
 * @package Models
 */
class Niva extends Car
{
    /**
     * Niva constructor.
     * @param int $power
     * @param string $transmission
     * @param string $carModel
     */
    public function __construct($power = 60, $transmission = 'Ручная', $carModel = 'Нива')
    {
        parent::__construct($power, $transmission, $carModel);
    }
}