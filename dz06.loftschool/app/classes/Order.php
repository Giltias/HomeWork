<?php

namespace DZ06\App\Classes;

/**
 * Класс заказов
 *
 * Class Order
 * @package DZ06\App\Classes
 */
class Order
{
    /**
     * Соединение с базой
     *
     * @var \DZ06\App\Classes\DB
     */
    private $db;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->db = DB::connect();
    }

    /**
     * Получение списка заказов
     *
     * @return array
     */
    public function getOrders()
    {
        $sql = "SELECT * FROM orders";
        return $this->db->run($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение списка заказов, которые совершил пользователь
     *
     * @param $user
     * @return array
     */
    public function getOrdersByUser($user)
    {
        $sql = "SELECT * FROM orders WHERE user_id = :user";
        $args = [['user', $user]];
        return $this->db->run($sql, $args)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение данных по заказу
     *
     * @param $id
     * @return mixed
     */
    public function getOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $args = [['id', $id]];
        return $this->db->run($sql, $args)->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Формирование адреса по заказу
     *
     * @param $id
     * @return string
     */
    public function formAddress($id)
    {
        $order = $this->getOrderById($id);
        $arr = [];
        $arr[0] = (!empty($order['street']))   ? ' ул.'   . $order['street']  : null;
        $arr[1] = (!empty($order['house']))    ? ' д.'    . $order['house']   : null;
        $arr[2] = (!empty($order['fraction'])) ? ' корп.' . $order['fraction']: null;
        $arr[3] = (!empty($order['room']))     ? ' кв.'   . $order['room']    : null;
        $arr[4] = (!empty($order['floor']))    ? ' этаж ' . $order['floor']   : null;
        return implode(',', array_filter($arr));
    }

    /**
     * Определение количества заказов у пользователя
     *
     * @param $order
     * @return int
     */
    public function getNumberOrderForUser($order)
    {
        $sql = "SELECT COUNT(o.id) num 
                FROM orders o 
                JOIN users u ON u.id = o.user_id 
                WHERE u.id = (SELECT o2.user_id FROM orders o2 WHERE o2.id = :order)";
        $args = [['order', $order]];
        $result = $this->db->run($sql, $args)->fetch(\PDO::FETCH_ASSOC);
        return (int)$result['num'];
    }

    /**
     * @param $order
     * @return array
     */
    private function getEmailAndNameByOrder($order)
    {
        $sql = "SELECT u.email, u.name 
                FROM orders o 
                JOIN users u ON u.id = o.user_id 
                WHERE u.id = (SELECT o2.user_id FROM orders o2 WHERE o2.id = :order)";
        $args = [['order', $order]];
        $result = $this->db->run($sql, $args)->fetch(\PDO::FETCH_ASSOC);
        return [['email' => $result['email'], 'name' => $result['name']]];
    }

    /**
     * Добавление нового заказа
     *
     * @param $user
     * @param array $data
     */
    public function addOrder($user, $data = [])
    {
        $sql = "INSERT INTO orders (
                  user_id,
                  street,
                  house,
                  fraction,
                  room,
                  floor,
                  comment,
                  payment,
                  `call`
                ) VALUES (
                  :user_id,
                  :street,
                  :house,
                  :fraction,
                  :room,
                  :floor,
                  :comment,
                  :payment,
                  :call
                )";

        $args = [
          ['user_id' , $user],
          ['street'  , empty($data['street']) ? null : $data['street']],
          ['house'   , empty($data['home']) ? null : $data['home']],
          ['fraction', empty($data['part']) ? null : $data['part']],
          ['room'    , empty($data['appt']) ? null : $data['appt']],
          ['floor'   , empty($data['floor']) ? null : $data['floor']],
          ['comment' , empty($data['comment']) ? null : $data['comment']],
          ['payment' , empty($data['payment']) ? null : $data['payment']],
          ['call'    , empty($data['callback']) ? null : $data['callback']],
        ];

        $this->db->run($sql, $args);
        $this->sendMail($this->db->lastInsId());
    }

    /**
     * @param $order
     * @return array
     */
    private function formDataByOrder($order)
    {
        $data = [];
        $address = $this->formAddress($order);
        $numOrder = $this->getNumberOrderForUser($order);
        $numOrderText = ($numOrder === 1) ?
            ' - это Ваш первый заказ!' :
            '! Это уже ' . $numOrder . ' заказ!';

        $data['order']     = $order;
        $data['emailData'] = $this->getEmailAndNameByOrder($order);
        $data['address']   = $address;
        $data['numOrder']  = $numOrderText;
        return $data;
    }

    /**
     * Посылка сообщения (сохранение файла в папку mails)
     *
     * @param $order
     */
    public function sendMail($order)
    {
        /*$mail  = '<h1>Ваш заказ будет №%s</h1><br>';
        $mail .= '<p>Ваш заказ будет доставлен по адресу: %s</p><br>';
        $mail .= '<p>Ваш заказ: DarkBeefBurger за 500 руб., 1 шт.</p><br>';
        $mail .= '<h3>Спасибо%s</h3><br>';

        $mail = sprintf($mail, $order, $address, $numOrderText);
        echo $mail;
        $date = new \DateTime();
        $dtText = $date->format('d.m.Y');
        $filename = $order . '-' . $dtText . '.html';
        file_put_contents('../../mails/' . $filename, $mail);*/

        $mail = new OrderMail();
        $mail->setParams($this->formDataByOrder($order));
        $mail->sendMessage();
    }
}
