<?php

namespace App\Http\Controllers;

use Illuminate\Pipeline\Pipeline;
use App\Library\ApiConnector;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        return view('home');
    }

    /**
     * @Function   getData
     * @param ApiConnector $ApiConnector
     * @Author    : Michail Fragkiskos
     * @Created at: 4/11/2020 at 5:56 μ.μ.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(ApiConnector $ApiConnector) {

        $methods = $ApiConnector->getAvailableMethods();
        $ApiConnector->setRequestType(($methods['date']['type'] ?? 'GET'));
        $ApiConnector->setMethod(($methods['date']['method'] ?? ''));
        $pipe = app(Pipeline::class)
            ->send($ApiConnector)
            ->through([
                \App\QueryFilters\From::class,
                \App\QueryFilters\Period::class,
            ])->thenReturn()->makeCall();

        return response()->json($pipe->getResponce()->data);
    }
}
