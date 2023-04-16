<?php

namespace App\Services;

use Throwable;

class ApiService
{
    protected $host_url , $token , $headers;

    public function __construct($host_url  , $token , $headers = [])
    {
        $this->host_url = $host_url;
        $this->token = $token;
        $this->headers = $headers;
    }


    /**
     * REST Get Method
     */
    public function get(string $endpoint , array $params = [])
    {
        try
        {
            $url = $this->host_url . $endpoint . '?' . http_build_query($params);
            $ch = curl_init();
            curl_setopt($ch , CURLOPT_URL , $url);
            curl_setopt($ch , CURLOPT_HTTPHEADER , $this->headers);
            curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);
            $response = curl_exec($ch);
            return json_decode($response , true);
        }catch(Throwable $e)
        {
            info($e);
            return $e;
        }
    }
}
