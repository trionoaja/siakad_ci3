<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeederApi {

    private $url;
    private $username;
    private $password;
    private $token;

    public function __construct($params = [])
    {
        $this->url      = isset($params['url']) ? $params['url'] : '';
        $this->username = isset($params['username']) ? $params['username'] : '';
        $this->password = isset($params['password']) ? $params['password'] : '';
    }

    private function send_request($method, $data = [])
    {
        $payload = [
            'act'  => $method,
            'token'=> $this->token,
            'filter' => isset($data['filter']) ? $data['filter'] : '',
            'order'  => isset($data['order']) ? $data['order'] : '',
            'limit'  => isset($data['limit']) ? $data['limit'] : '',
            'offset' => isset($data['offset']) ? $data['offset'] : '',
            'record' => isset($data['record']) ? $data['record'] : [],
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    public function get_token()
    {
        $payload = [
            'act'      => 'GetToken',
            'username' => $this->username,
            'password' => $this->password
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $result = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($result, true);
        if (!empty($res['data']['token'])) {
            $this->token = $res['data']['token'];
            return $this->token;
        }
        return false;
    }

    public function get_data($method, $filter = '')
    {
        return $this->send_request($method, ['filter' => $filter]);
    }
}
