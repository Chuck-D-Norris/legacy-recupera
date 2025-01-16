<?php

use App\Controllers\Api\MapController;

return [
    'GET' => [
        '/api/map/zones' => [
            'controller' => MapController::class,
            'method' => 'index',
        ],
        '/api/map/elementtypes' => [
            'controller' => MapController::class,
            'method' => 'getElementTypes',
        ],
        '/api/map/treetypes' => [
            'controller' => MapController::class,
            'method' => 'getTreeTypes',
        ],
        '/api/map/elements/:id' => [
            'controller' => MapController::class,
            'method' => 'getElement',
        ],
    ],
    'POST' => [
        '/api/map/zones' => [
            'controller' => MapController::class,
            'method' => 'createZone',
        ],
        '/api/map/elements' => [
            'controller' => MapController::class,
            'method' => 'createElement',
        ],
    ],
    'PUT' => [
        '/api/map/zones/name' => [
            'controller' => MapController::class,
            'method' => 'updateZoneName',
        ],
        '/api/map/zones/color' => [
            'controller' => MapController::class,
            'method' => 'updateZoneColor',
        ],
        '/api/map/elements/description' => [
            'controller' => MapController::class,
            'method' => 'updateElementDescription',
        ],
        '/api/map/zones/description' => [
            'controller' => MapController::class,
            'method' => 'updateZoneDescription',
        ],
    ],
    'DELETE' => [
        '/api/map/zones' => [
            'controller' => MapController::class,
            'method' => 'deleteZone',
        ],
        '/api/map/elements' => [
            'controller' => MapController::class,
            'method' => 'deleteElement',
        ],
    ],
];
