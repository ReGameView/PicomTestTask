<?php

namespace App\Http\Controllers;

use Validator;
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
        $validator = Validator::make($request->all(), [
            'search' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            echo "1"; // Сука.. >255символов
        }else {
            $query = str_replace(' ', '%20',$request->search);
            $key = 'd885c4fec83adc755c57e7b04c5c6c33';
            $uri = 'http://apilayer.net/api/detect?access_key='.$key.'&query='.$query;
            $client = new Client();
            $response = $client->request('GET', $uri);
            $data = json_decode($response->getBody());
            $out = "";
            foreach($data->results as $item) {
                $out .= "<img src='img/country/".$item->language_code.".png'> ".$item->language_name." ". round($item->percentage, 2)."%<br/>";
            }

            echo $out;
            $history = new History();
            $history->search = $request->search;
            $history->result = $out;
            $history->save();
        }

    }

    public function history()
    {
        $history = History::where('id', '>', '0')->paginate(10);
        return view('history', ['history' => $history]);
    }
}
