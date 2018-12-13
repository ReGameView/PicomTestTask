<?php

namespace App\Providers;

use GuzzleHttp\Client;

class ApiServiceProvider
{
    protected $url;
    protected $key; // Ключ лежит в глоб. конфиге
    protected $http;

    public function __construct()
    {
        $this->url = "http://apilayer.net/api/detect";
        $this->key = config('app.keyForApi');;
//        $this->http = $client;
        $this->http = new Client();
    }

    public function getApi($uri = null)
    {
        // Replace SPACE char on %20
        $uri = str_replace(' ', '%20', $uri);

        $full_path = $this->url. '?access_key='.$this->key.'&query=' . $uri;
        $request = $this->http->request('GET', $full_path);
        $response = $request ? $request->getBody() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if($response && $status == 200 && $response !== null) {
            return (object) json_decode($response);
        }

        return null;
    }
}