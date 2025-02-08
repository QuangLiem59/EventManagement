<?php

namespace App\Ship\Classes;

use Exception;

class GoogleClient
{
    private $appId = null;
    private $clientId = null;
    private $clientSecret = null;
    private $redirectUri = null;
    private $scopes = [];
    private $json = null;

    public const DRIVE = 'https://www.googleapis.com/auth/drive';
    public const SPREADSHEETS = 'https://www.googleapis.com/auth/spreadsheets';
    public const MESSAGING = 'https://www.googleapis.com/auth/firebase.messaging';

    function __construct(array $config = [])
    {
        $this->appId = isset($config['app_id']) ? $config['app_id'] : null;
        $this->clientId = isset($config['client_id']) ? $config['client_id'] : null;
        $this->clientSecret = isset($config['client_secret']) ? $config['client_secret'] : null;
        $this->redirectUri = isset($config['redirect_uri']) ? $config['redirect_uri'] : null;
        $this->scopes = isset($config['scope']) ? explode(',', $config['scope']) : [];
    }

    /**
     * Tạo URL xác thực
     * 
     * @param array|null $scopes
     * @return string
     */
    public function createAuthUrl(mixed $scopes = null)
    {
        if ($scopes) {
            $this->setScopes($scopes);
        }

        if (!$this->clientId) {
            throw new Exception('Client Id is not exists');
        }

        if (!$this->redirectUri) {
            throw new Exception('Redirect Uri is not exists');
        }

        if (empty($this->scopes)) {
            throw new Exception('Scope is empty');
        }

        $params = [
            'client_id=' . $this->clientId,
            'response_type=code',
            'scope=' . implode(',', $this->scopes),
            'access_type=offline',
            'include_granted_scopes=true',
            'redirect_uri=' . $this->redirectUri,
        ];
    
        return 'https://accounts.google.com/o/oauth2/v2/auth?' . implode('&', $params);
    }

    /**
     * Cập nhật App Id
     * 
     * @param string $appId
     */
    public function setAppId(string $appId)
    {
        $this->appId = $appId;
    }

    /**
     * Cập nhật Client Id
     * 
     * @param string $clientId
     */
    public function setClientId(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Cập nhật Client Secret
     * 
     * @param string $clientSecret
     */
    public function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * Cập nhật URL điều hướng khi xác thực thành công
     * 
     * @param string $url
     */
    public function setRedirectUri(string $url)
    {
        $this->redirectUri = $url;
    }

    /**
     * Thực hiện xác thực tài khoản từ URL điều hướng
     * 
     * @param string $code Lấy từ URL điều hướng
     */
    public function authorization(string $code)
    {
        if (!$this->redirectUri) {
            throw new \Exception('URL callback is not exists');
        }

        $api = 'https://oauth2.googleapis.com/token';
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
            CURLOPT_POSTFIELDS => http_build_query([
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'code' => $code,
                'redirect_uri' => $this->redirectUri,
                'grant_type' => 'authorization_code'
            ]),
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $this->setAccessToken($res);
    }

    /**
     * Lấy thông tin token đã xác thực
     * 
     * @return array
     */
    public function getAccessToken()
    {
        return $this->json;
    }

    /**
     * Cập nhật thông tin token
     * 
     * @param array|string $content
     * 
     * @return array
     */
    public function setAccessToken(mixed $content)
    {
        if (is_string($content)) {
            $content = json_decode($content, true);
        }

        if (!is_array($content)) {
            throw new Exception('Access token is invalid');
        }

        if (!isset($content['created'])) {
            $content['created'] = time();
        }
        
        if ($this->json) {
            $this->json = array_merge($this->json, $content);
        } else {
            $this->json = $content;
        }

        return $this->json;
    }

    /**
     * Cập nhật Scopes
     * 
     * @param array|string $scopes
     */
    public function setScopes(mixed $scopes)
    {
        if (is_string($scopes)) {
            $scopes = explode(',', $scopes);
        }

        if (!is_array($scopes)) {
            throw new Exception('Scopes is invalid');
        }

        array_push($this->scopes, ...$scopes);
    }

    /**
     * Kiểm tra token đã hết hạn
     * 
     * @return bool
     */
    public function isAccessTokenExpired()
    {
        if (!$this->json OR !isset($this->json['created']) OR !isset($this->json['expires_in'])) {
            return true;
        }

        $time = $this->json['created'] + $this->json['expires_in'];

        return $time < time();
    }

    /**
     * Lấy Refresh Token
     * 
     * @return string
     */
    public function getRefreshToken()
    {
        if (!$this->json OR !isset($this->json['refresh_token'])) {
            return null;
        }

        return $this->json['refresh_token'];
    }

    /**
     * Làm mới token bằng Refresh Token
     * 
     * @param string|null $token
     * @return array
     */
    public function fetchAccessTokenWithRefreshToken($token = null)
    {
        if (!$token) {
            $token = $this->getRefreshToken();
        }

        if (!$token) {
            throw new Exception('Refresh Token is not exists');
        }

        if (!$this->clientId) {
            throw new Exception('Client Id is not exists');
        }

        if (!$this->clientSecret) {
            throw new Exception('Client Secret is not exists');
        }

        $api = 'https://oauth2.googleapis.com/token';
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
            CURLOPT_POSTFIELDS => http_build_query([
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'refresh_token',
                'refresh_token' => $token,
            ]),
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $this->setAccessToken($res);
    }

    /**
     * Đẩy thông báo Firebase đến 1 thiết bị hoặc topic
     * 
     * @param array $payload
     * @return string
     */
    private function send(array $payload)
    {
        $api = 'https://fcm.googleapis.com/v1/projects/' . $this->appId . '/messages:send';
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->json['access_token'],
            ],
            CURLOPT_POSTFIELDS => json_encode([
                'message' => $payload,
            ]),
        ]);
        
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    /**
     * Đẩy thông báo Firebase nhiều thiết bị cùng lúc
     * 
     * @param array $devices Danh sách thiết bị nhận thông báo
     * @param string $title Tiêu đề thông báo
     * @param string $body Nội dung thông báo
     * @param array $data Dữ liệu bổ sung
     * @return string
     */
    private function sendAll(array $devices, string $title, string $body, array $data = [])
    {
        $content = [
            'notification' => [
                'title' => $title,
                'body' => $body,
            ]
        ];

        if (!empty($data)) {
            $content['data'] = $data;
        }

        $api = 'https://fcm.googleapis.com/batch';
        $requests = [];
        foreach ($devices as $device) {
            $request = "Content-Type: application/http\n";
            $request .= "Content-Transfer-Encoding: binary\n\n";

            $request .= "POST /v1/projects/" . $this->appId . "/messages:send\n";
            $request .= "Content-Type: application/json\n";
            $request .= "accept: application/json\n\n";
            
            $request .= "{\n";
            $request .= "\"message\": " . json_encode([...$content, 'token' => $device]) . "\n";
            $request .= "}";

            $requests[] = $request;
        }

        $payload = "--subrequest_boundary\n" . implode("\n--subrequest_boundary\n", $requests) . "\n--subrequest_boundary--";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/mixed; boundary=subrequest_boundary',
                'Authorization: Bearer ' . $this->json['access_token'],
            ],
            CURLOPT_POSTFIELDS => $payload,
        ]);
        
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

    /**
     * Đẩy thông báo Firebase đến 1 hoặc nhiều thiết bị
     * 
     * @param array|string $devices Danh sách thiết bị nhận thông báo
     * @param string $title Tiêu đề thông báo
     * @param string $body Nội dung thông báo
     * @param array $data Dữ liệu bổ sung
     * @return string
     */
    public function sendToDevice(mixed $devices, string $title, string $body, array $data = [])
    {
        if (!$this->appId) {
            throw new Exception('App Id is not exists');
        } elseif (!$this->json) {
            throw new Exception('Access token is not exists');
        } elseif (empty($devices)) {
            throw new Exception('Device is empty');
        }

        if (is_string($devices) and !is_array($devices)) {
            throw new Exception('Devices is invalid');
        }

        $devices = (array)$devices;
        $devices = array_unique($devices);

        if (count($devices) > 500) {
            throw new Exception('The number of devices is too large');
        }

        if (count($devices) == 1) {
            $payload = [
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                ],
                'token' => $devices[0],
            ];
    
            if (!empty($data)) {
                $payload['data'] = $data;
            }

            return $this->send($payload);
        }

        return $this->sendAll($devices, $title, $body, $data);
    }

    /**
     * Gửi thông báo Firebase theo chủ đề
     * 
     * @param string $topic Tên chủ đề
     * @param string $title Tiêu đề thông báo
     * @param string $body Nội dung thông báo
     * @param array $data Dữ liệu bổ sung
     * @return string
     */
    public function sendToTopic(string $topic, string $title, string $body, array $data = [])
    {
        $payload = [
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'topic' => $topic,
        ];

        if (!empty($data)) {
            $payload['data'] = $data;
        }

        return $this->send($payload);
    }
}