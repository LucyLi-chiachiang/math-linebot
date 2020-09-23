<?php

namespace App\Jobs;

use App\Services\Calculator;
use App\Services\CreateLineBot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendLineMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected array $requestArray;
    protected $signature;
    protected $content;

    public function __construct($signature, $content, $requestArray)
    {
        $this->signature = $signature;
        $this->content = $content;
        $this->requestArray = $requestArray;
    }

    /**
     * Execute the job.
     *
     * @param CreateLineBot $createLineBot
     * @param Calculator $calculator
     * @return void
     * @throws \ReflectionException
     */
    public function handle(CreateLineBot $createLineBot, Calculator $calculator)
    {
        //
        $bot = $createLineBot->create($this->signature, $this->content);

        $events = $this->requestArray['events'];
        foreach ($events as $event) {
            // 不是訊息的event先不處理
            if ($event['type'] != 'message') continue;
            $messageType = $event['message']['type'];
            $message = $event['message']['text'];

            // 不是文字訊息的類型先不處理
            if ($messageType != 'text') continue;

            $replyMessage = $calculator->calculate($message);
            $response = $bot->replyText($event['replyToken'], $replyMessage);
            if ($response->isSucceeded()) {
                logger('reply successfully');
            }

        }
    }
}
