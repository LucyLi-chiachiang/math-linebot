<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SendLineMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot;

class LineWebhookController extends Controller
{
    //
    public function webhook(Request $request)
    {
        $signature = $request->header(LINEBot\Constant\HTTPHeader::LINE_SIGNATURE);
        $content = $request->getContent();
        SendLineMessage::dispatch($signature, $content, $request->all());
        return $this->http200('done');
    }

    private function http200($string)
    {
        return response($string, 200);
    }
}
