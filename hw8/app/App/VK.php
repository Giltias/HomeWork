<?php

namespace HW8\App;


/**
 * Class VK
 * @package HW8\App
 */
class VK
{
    /**
     * @var int
     */
    private $appId = 6300961;
    /**
     * @var string
     */
    private $protectedKey = 'CrucgZBhPtC17pTmv6he';
    /**
     * @var string
     */
    private $redirectUrl = 'http://hw8/admin/vk/';
    /**
     * @var string
     */
    private $oauth = 'https://oauth.vk.com/';
    /**
     * @var string
     */
    private $apiVK = 'https://api.vk.com/method/';
    /**
     * @var string
     */
    private $token = '';

    /**
     * @return bool
     */
    public function checkToken()
    {
        return empty($this->token);
    }

    /**
     * @param $url
     * @return mixed
     */
    private function json_decode($url)
    {
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    /**
     *
     */
    public function authUrl()
    {
        $params = http_build_query([
            'client_id' => $this->appId,
            'redirect_uri' => 'https://oauth.vk.com/blank.html',
            'scope' => 'friends,wall,offline',
            'response_type' => 'token',
            'v' => '5.69'
        ]);
        $url = $this->oauth . 'authorize?' . $params;
        header('Location: ' . $url);
    }

    /**
     * @param $code
     * @param $method
     * @return mixed
     */
    public function accessToken($code, $method)
    {
        $params = http_build_query([
            'client_id' => $this->appId,
            'client_secret' => $this->protectedKey,
            'redirect_uri' => $this->redirectUrl . $method,
            'code' => $code
        ]);
        $url = $this->oauth . 'access_token?' . $params;
        $data = $this->json_decode($url);
        return $data['access_token'];
    }

    /**
     * @return mixed
     */
    public function getWall()
    {
        $url = $this->apiVK . "wall.get?count=1&access_token={$this->token}";
        $data = $this->json_decode($url);
        return $data;
    }

    /**
     * @return mixed
     */
    public function postOnWall()
    {
        $params  = http_build_query([
            'message' => 'тест',
            'access_token' => $this->token
        ]);
        $url = $this->apiVK . "wall.post?" . $params;
        $data = $this->json_decode($url);
        return $data;
    }
}