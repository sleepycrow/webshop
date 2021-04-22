<?php
http_response_code(404);
die(json_encode([
  'ok' => false,
  'errText' => 'No such endpoint.'
]));
