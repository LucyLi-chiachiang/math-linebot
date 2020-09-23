<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendLineMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LineWebhookController extends Controller
{
    //
    public function webhook(Request $request)
    {
        SendLineMessage::dispatch($request);
        return $this->http200('done');
    }

    private function http200($string)
    {
        return response($string, 200);
    }
}
