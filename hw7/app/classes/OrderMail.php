<?php

namespace HW7\App\Classes;


class OrderMail extends AbstractMail
{
    /**
     * Функция формирования тела письма и других основных параметров
     *
     * @param array $data
     * @return mixed|void
     */
    function setParams($data = [])
    {
        $this->setFrom('ДЗ');
        $this->setSubject('Заказ с портала Burgers. ДЗ LoftSchool');
        $this->addAddresses($data['emailData']);
        $this->setHtmlFromFile('order.html.twig', $data);
        $this->setAltBody('Ваш заказ отправлен!');
    }
}