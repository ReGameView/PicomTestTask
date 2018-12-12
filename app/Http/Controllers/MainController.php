<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\History;
use App\Result;
use App\Country;

use GuzzleHttp\Client;

class MainController extends Controller
{
    public function index()
    {
        $history = History::with('result')
            ->take(10)
            ->orderBy('created_at', 'desc')
            ->with('country')
            ->get();
//        echo asset('img/country/'. $history[0]->country[0]->short_name .'.png');
        return view('main', ['history' => $history]);
    }

    public function ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            echo "1"; // >255символов
        }else {
            $query = str_replace(' ', '%20',$request->search);
            $key = 'd885c4fec83adc755c57e7b04c5c6c33';
            $uri = 'http://apilayer.net/api/detect?access_key='.$key.'&query='.$query;
            $client = new Client();
            $response = $client->request('GET', $uri);
            $data = json_decode($response->getBody());
            $json_data = [];
            $history = new History();
            $history->search = $request->search;
            $history->save();

            foreach($data->results as $item) {
                $country = Country::where('name', $item->language_name)->first();

                if($country === null)
                {
                    $country = new Country();
                    $country->name = $item->language_name;
                    $country->short_name = $item->language_code;
                    $country->save();
                }
                array_push($json_data, ['name' => $country->name, 'img' => asset('img/country/'.$country->short_name.'.png'), 'percents' => round($item->percentage, 2)]);
                $result = new Result();
                $result->history_id = $history->id;
                $result->country_id = $country->id;
                $result->percents = round($item->percentage, 2);
                $result->save();
            }
            return response()->json($json_data);
        }
    }

    public function history()
    {
        $history = History::where('id', '>', '0')->paginate(10);
        return view('history', ['history' => $history]);
    }
}
