<?php

namespace Models;


/**
 * Class Passat
 * @package Models
 */
class Passat extends Car
{
    /**
     * Passat constructor.
     * @param int $power
     * @param string $transmission
     * @param string $carModel
     */
    public function __construct($power = 120, $transmission = 'Автоматическая', $carModel = 'Passat')
    {
        parent::__construct($power, $transmission, $carModel);
    }
}