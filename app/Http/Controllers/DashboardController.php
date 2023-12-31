<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\dht22Sensor;
use App\Models\mq2Sensor;
use App\Models\mq135Sensor;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function data()
    {
        $datas = Data::orderBy('created_at', 'DESC')->get();
        return view('dashboard.data', compact('datas'));
    }

    public function dht22()
    {
        $datas = dht22Sensor::orderBy('time', 'DESC')->get();
        $temperature = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('temperature');
        $humidity = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('humidity');
        $heat_index = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('heat_index');
        $timeLabels = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('time');
        return view('dashboard.data_dht22', compact('datas', 'temperature', 'humidity', 'heat_index', 'timeLabels'));
    }

    public function temperature()
    {
        $timeLabels = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('time');
        $temperature = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('temperature');

        $response = [
            'timeLabels' => $timeLabels,
            'temperature' => $temperature,
        ];
        return response()->json($response);
    }

    public function humidity()
    {
        $timeLabels = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('time');
        $humidity = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('humidity');

        $response = [
            'timeLabels' => $timeLabels,
            'humidity' => $humidity,
        ];
        return response()->json($response);
    }

    public function heat_index()
    {
        $timeLabels = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('time');
        $heat_index = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('heat_index');

        $response = [
            'timeLabels' => $timeLabels,
            'heat_index' => $heat_index,
        ];
        return response()->json($response);
    }

    public function time()
    {
        $timeLabels = dht22Sensor::orderBy('time', 'DESC')->take(5)->pluck('time');
        return view('dashboard.data_time', compact('timeLabels'));
    }

    public function mq2()
    {
        $datas = mq2Sensor::orderBy('time', 'DESC')->get();
        return view('dashboard.data_mq2', compact('datas'));
    }

    public function mq135()
    {
        $datas = mq135Sensor::orderBy('time', 'DESC')->get();
        return view('dashboard.data_mq135', compact('datas'));
    }
}
