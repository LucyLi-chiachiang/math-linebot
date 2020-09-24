# 計算姬

## 環境
### Framework
- Laravel 8.0
- php 7.4.8
### Queue
- "predis/predis": "^1.1"
### Line SDK
- "linecorp/line-bot-sdk": "^4.5"

## 檔案位置
- Jobs -> app/Jobs
- Services -> app/Services
- Line webhook 使用的 controller -> app/Http/Controllers/Api/LineWebhookController.php

## Test 位置
- ServicesTest -> tests/Unit
- ControllerTest -> tests/Feature
