<?php

declare(strict_types=1);

return [
    'enabled' => env('SCHEMA_VALIDATOR_ENABLED', true),

    /* Version of the scoring rules shown under the score; change it when the checks or points change. */
    'ruleset' => '2026-11-14',

    'fetch' => [
        'page_bytes' => 5 * 1024 * 1024,
    ],

    'rate_limit' => [
        'per_hour' => (int) env('SCHEMA_VALIDATOR_PER_HOUR', 10),
    ],

    /* Short: people fix the markup and check again right away. */
    'cache' => [
        'ttl' => 120,
    ],
];
