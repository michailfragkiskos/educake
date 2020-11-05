<?php
 namespace App\Library;

use App\Setting;

class ApiConnector
{
    private $data = [];
    private $url = '';
    private $port = 0;
    private $user = false;
    private $passw = false;
    private $method = '';
    private $responce = [];
    private $availableMethods = [];
    private $errorMsg = '';
    private $error = false;
    private $requestType = 'GET';

    /**
     * @Function   getErrorMsg
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    /**
     * @Function   hasError
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->error;
    }

    /**
     * @Function   getRequestType
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->requestType;
    }

    /**
     * @Function   setRequestType
     * @param string $requestType
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return $this
     */
    public function setRequestType(string $requestType): ApiConnector
    {
        $this->requestType = $requestType;
        return $this;
    }

    /**
     * @return array
     */
    public function getAvailableMethods(): array
    {
        return $this->availableMethods;
    }


    /**
     * @Function   getData
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @Function   setData
     * @param array $data
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return $this
     */
    public function setData(array $data): ApiConnector
    {
        $this->data = array_merge($data,$this->data);
        return $this;
    }

    /**
     * @Function   getUrl
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @Function   getPort
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @Function   getMethod
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:57 μ.μ.
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @Function   setMethod
     * @param string $method
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return $this
     */
    public function setMethod(string $method): ApiConnector
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @Function   getResponce
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return array
     */
    public function getResponce()
    {
        return $this->responce;
    }

    /**
     * ApiConnector constructor.
     */
    public function __construct()
    {

        $configData = $this->get_config();
        $this->availableMethods = $configData['methods'] ?? false;
        $this->url = $configData['API_REMOTE_URL'] ?? false;
        $this->port = $configData['API_REMOTE_PORT'] ?? false;
        $this->user = $configData['API_USERNAME'] ?? false;
        $this->passw = $configData['API_PASSWORD'] ?? false;
    }

    /**
     * @Function   get_config
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function get_config()
    {
        return config('api');
    }

    /**
     * @Function   allowedRequestTypes
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return array|false|string[]
     */
    public function allowedRequestTypes()
    {
        // get the request Types
        $allowedMethods = @explode(',', env('ALLOWED_REQUEST'));
        return (is_array($allowedMethods)) ? $allowedMethods : [$allowedMethods];
    }

    /**
     * @Function   makeCall
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return $this
     */
    public function makeCall()
    {
        if (!in_array($this->getRequestType(), $this->allowedRequestTypes())) {
             return $this;
        }
        $vars = $this->getData();
        try {
            $ch = curl_init();
            switch ($this->getRequestType()) {
                case 'PUT':
                    $url = $this->getUrl() . $this->getMethod();
                    $vars = json_encode($vars, JSON_UNESCAPED_UNICODE);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type:application/json; charset=utf-8',
                        'Accept: */*',
                        'User-Agent: =Curl/1.0',
                        'Accept-Encoding: gzip, deflate, br',
                        'Content-Length: ' . strlen($vars)));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
                    break;
                case 'POST':
                    $url = $this->getUrl() . $this->getMethod();
                    $vars = json_encode($vars);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Content-Type:application/json; charset=utf-8',
                            'Accept: */*',
                            'User-Agent: Curl/1.0',
                            'Accept-Encoding: gzip, deflate, br',
                            'Content-Length: ' . strlen($vars))
                    );
                    break;
                default:
                    $vars = '/' . implode('/', $vars);

                    $url = $this->getUrl() . $this->getMethod() . $vars;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Accept: application/json; charset=utf-8',
                            'Accept: */*',
                            'User-Agent: Curl/1.0',
                            'Accept-Encoding: gzip, deflate, br')
                    );
                    break;
            }


            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $error = curl_error($ch);
            $errno = curl_errno($ch);
            if (is_resource($ch)) {
                curl_close($ch);
            }

            if (0 !== $errno) {
                $this->errorMsg = $error;
                $this->error = true;
                return $this;
            }
        } catch (\Exception $exception) {
           return $exception->getMessage();
        }
        $this->decodeData($response);
        return $this;
    }

    /**
     * @Function   encodeData
     * @param $data
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return false|string
     */
    private function encodeData($data)
    {
        return $this->responce = @json_encode($data, JSON_UNESCAPED_UNICODE);

    }

    /**
     * @Function   decodeData
     * @param $data
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     */
    private function decodeData($data)
    {

        $this->responce = @json_decode($data);
    }
}
