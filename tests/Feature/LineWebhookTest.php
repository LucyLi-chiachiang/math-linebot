<?php

namespace Tests\Feature;

use App\Jobs\SendLineMessage;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class LineWebhookTest extends TestCase
{
    public function test_job_is_dispatched()
    {
        Queue::fake();
        // Assert that no jobs were pushed...
        Queue::assertNothingPushed();
        $this->postJson('/api/line/webhook', $this->webhookEventObject());
        Queue::assertPushed(SendLineMessage::class);
    }

    private function webhookEventObject()
    {
        return
            ['events' =>
                [
                    [
                        "replyToken" => "0f3779fba3b349968c5d07db31eab56f",
                        'type' => 'message',
                        'message' => ['type' => 'text', 'text' => '1+1']
                    ],

                ]
            ];
    }
}
