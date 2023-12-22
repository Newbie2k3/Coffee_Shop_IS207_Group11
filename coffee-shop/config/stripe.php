<?php
  
return [
    'pk' => env('STRIPE_KEY'),
    'sk' => env('STRIPE_SECRET'),
    'ep' => env('STRIPE_WEBHOOK_ENDPOINT'),
];