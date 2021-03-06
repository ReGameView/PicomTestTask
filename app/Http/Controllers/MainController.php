<?php

namespace App\Http\Controllers;

use App\Services\LanguageDetectorService;
use App\Models\History;
use App\Models\Result;
use App\Models\Country;
use App\Http\Requests\MainInputRequest;

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
        return view('main', ['history' => $history]);
    }

    public function ajax(MainInputRequest $request, LanguageDetectorService $api)
    {
        $data = $api->getApi($request->search);

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

    public function history()
    {
        $history = History::where('id', '>', '0')->paginate(10);
        return view('history', ['history' => $history]);
    }
}
