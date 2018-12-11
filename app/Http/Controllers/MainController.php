<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\History;
use GuzzleHttp\Client;

class MainController extends Controller
{
    public function index()
    {
        $history = History::where('id', '>', '0')->take(10)->orderBy('created_at', 'desc')->get();
        return view('main', ['history' => $history]);
    }

    public function ajax(Request $request)
    {
        $query = str_replace(' ', '%20',$request->search);
        $key = 'd885c4fec83adc755c57e7b04c5c6c33';
        $uri = 'http://apilayer.net/api/detect?access_key='.$key.'&query='.$query;
        $client = new Client();
        $response = $client->request('GET', $uri);
        $data = json_decode($response->getBody());
        $out = "";
        foreach($data->results as $item) {
            $out .= "<img src='img/country/".$item->language_code.".png'> ".$item->language_name." ".$item->percentage."%<br/>";
        }

        echo $out;
        $history = new History();
        $history->search = $request->search;
        $history->result = $out;
        $history->save();
    }

    public function history()
    {
        $history = History::where('id', '>', '0')->paginate(10);
        return view('history', ['history' => $history]);
    }
}
