<?php

namespace App\Services;

use GuzzleHttp\Client;
use \Illuminate\Http\Response;

class LanguageDetectorService
{
    protected $url;
    protected $key;
    protected $http;

    public function __construct(Client $client)
    {
        $this->url = config('api.url');
        $this->key = config('api.key');;
        $this->http = $client;
    }

    public function getApi($uri = null)
    {
        // Replace SPACE char on %20
        $uri = str_replace(' ', '%20', $uri);

        $full_path = $this->url. '?access_key='.$this->key.'&query=' . $uri;
        $request = $this->http->request('GET', $full_path);
        $response = $request ? $request->getBody() : null;
        $status = $request ? $request->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        if($response && $status == 200 && $response !== null) {
            return (object) json_decode($response);
        }

        return null;
    }
}