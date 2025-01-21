<?php

use App\Controllers\Admin\AccountController;
use App\Controllers\Admin\ContractController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ElementController;
use App\Controllers\Admin\ElementTypeController;
use App\Controllers\Admin\IncidenceController;
use App\Controllers\Admin\InventoryController;
use App\Controllers\Admin\ResourceController;
use App\Controllers\Admin\ResourceTypeController;
use App\Controllers\Admin\StatsController;
use App\Controllers\Admin\TaskTypeController;
use App\Controllers\Admin\TreeTypeController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\WorkOrderController;
use App\Controllers\Admin\ZoneController;
use App\Middlewares\AdminMiddleware;

return [
    'GET' => [
        // === App GET Routes
        '/admin' => [
            'controller' => DashboardController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/inventory' => [
            'controller' => InventoryController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/account' => [
            'controller' => AccountController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Users GET Routes
        '/admin/users' => [
            'controller' => UserController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/user/create' => [
            'controller' => UserController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/user/:id/edit' => [
            'controller' => UserController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/user/:id/delete' => [
            'controller' => UserController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === WorkOrders GET Routes
        '/admin/work-orders' => [
            'controller' => WorkOrderController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/work-order/create' => [
            'controller' => WorkOrderController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/work-order/:id/edit' => [
            'controller' => WorkOrderController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/work-order/:id/delete' => [
            'controller' => WorkOrderController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Zones GET Routes
        '/admin/zones' => [
            'controller' => ZoneController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/zone/create' => [
            'controller' => ZoneController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/zone/:id/edit' => [
            'controller' => ZoneController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/zone/:id/delete' => [
            'controller' => ZoneController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === TreeTypes GET Routes
        '/admin/tree-types' => [
            'controller' => TreeTypeController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/tree-type/create' => [
            'controller' => TreeTypeController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/tree-type/:id/edit' => [
            'controller' => TreeTypeController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/tree-type/:id/delete' => [
            'controller' => TreeTypeController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Incidence GET Routes
        '/admin/incidence' => [
            'controller' => IncidenceController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/incidence/create' => [
            'controller' => IncidenceController::class,
            'method' => 'get',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/incidence/all' => [
            'controller' => IncidenceController::class,
            'method' => 'findall',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Elements GET Routes
        '/admin/elements' => [
            'controller' => ElementController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element/create' => [
            'controller' => ElementController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element/:id/edit' => [
            'controller' => ElementController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element/:id/delete' => [
            'controller' => ElementController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // ElementType
        '/admin/element-types' => [
            'controller' => ElementTypeController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element-type/create' => [
            'controller' => ElementTypeController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element-type/:id/edit' => [
            'controller' => ElementTypeController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element-type/:id/delete' => [
            'controller' => ElementTypeController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Resources GET Routes
        '/admin/resources' => [
            'controller' => ResourceController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource/create' => [
            'controller' => ResourceController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource/:id/edit' => [
            'controller' => ResourceController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource/:id/delete' => [
            'controller' => ResourceController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === ResourceType GET Routes
        '/admin/resource-types' => [
            'controller' => ResourceTypeController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource-type/create' => [
            'controller' => ResourceTypeController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource-type/:id/edit' => [
            'controller' => ResourceTypeController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource-type/:id/delete' => [
            'controller' => ResourceTypeController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === TaskTypes GET Routes
        '/admin/task-types' => [
            'controller' => TaskTypeController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/task-types/create' => [
            'controller' => TaskTypeController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/task-types/:id/edit' => [
            'controller' => TaskTypeController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/task-types/:id/delete' => [
            'controller' => TaskTypeController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Contracts GET Routes
        '/admin/contracts' => [
            'controller' => ContractController::class,
            'method' => 'index',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/contract/create' => [
            'controller' => ContractController::class,
            'method' => 'create',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/contract/:id/edit' => [
            'controller' => ContractController::class,
            'method' => 'edit',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/contract/:id/delete' => [
            'controller' => ContractController::class,
            'method' => 'destroy',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/stats' => [
            'middlewares' => [AdminMiddleware::class],
            'controller' => StatsController::class,
            'method' => 'index',
        ],
    ],
    'POST' => [
        '/admin/user/store' => [
            'controller' => UserController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/user/:id/update' => [
            'controller' => UserController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Elements POST Routes
        '/admin/element/store' => [
            'controller' => ElementController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element/:id/update' => [
            'controller' => ElementController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Element-Types POST Routes
        '/admin/element-type/store' => [
            'controller' => ElementTypeController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/element-type/:id/update' => [
            'controller' => ElementTypeController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === TypeResources POST Routes
        '/admin/resource-type/store' => [
            'controller' => ResourceTypeController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource-type/:id/update' => [
            'controller' => ResourceTypeController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === WorkOrders POST Routes
        '/admin/work-order/store' => [
            'controller' => WorkOrderController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/work-order/:id/update' => [
            'controller' => WorkOrderController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Zones POST Routes
        '/admin/zone/store' => [
            'controller' => ZoneController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/zone/:id/update' => [
            'controller' => ZoneController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === TreeTypes POST Routes
        '/admin/tree-type/store' => [
            'controller' => TreeTypeController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/tree-type/:id/update' => [
            'controller' => TreeTypeController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === TaskTypes POST Routes
        '/admin/task-types/store' => [
            'controller' => TaskTypeController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/task-types/:id/update' => [
            'controller' => TaskTypeController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
        // === Contracts POST Routes
        '/admin/contract/store' => [
            'controller' => ContractController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/contract/:id/update' => [
            'controller' => ContractController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],

        // === Config POST Routes

        '/admin/account' => [
            'controller' => AccountController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],

        // === Miscelaneous POST Routes

        '/admin/set-contract' => [
            'controller' => ContractController::class,
            'method' => 'setCurrentContract',
            'middlewares' => [AdminMiddleware::class],
        ],

        // Post Resources
        '/admin/resource/store' => [
            'controller' => ResourceController::class,
            'method' => 'store',
            'middlewares' => [AdminMiddleware::class],
        ],
        '/admin/resource/:id/update' => [
            'controller' => ResourceController::class,
            'method' => 'update',
            'middlewares' => [AdminMiddleware::class],
        ],
    ],
];
