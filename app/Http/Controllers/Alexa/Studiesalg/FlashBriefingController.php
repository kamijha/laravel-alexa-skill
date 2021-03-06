<?php

namespace App\Http\Controllers\Alexa\Studiesalg;

use App\Http\Controllers\Controller;
use App\Integrations\Studiesalg\Client;
use App\Integrations\Studiesalg\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlashBriefingController extends Controller
{

    /**
     * @var
     */
    private $studiesalg;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->studiesalg = $client;
    }

    /**
     * @return $this
     */
    public function index()
    {
        return [
            'uid' => md5(time()),
            'updateDate' => str_replace(' ', 'T', Carbon::now()->toDateTimeString()).'.0Z',
            'titleText' => 'Studiesalg Today',
            'mainText' => (string) new Status($this->studiesalg->orders()->open())
        ];
    }

}

