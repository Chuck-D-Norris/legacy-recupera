<?php

namespace App\Controllers\Admin;

use App\Core\Session;
use App\Core\View;
use App\Models\WorkOrder;
use App\Models\TaskType;
use App\Models\Zone;
use App\Models\User;
use App\Models\TreeType;
use App\Models\WorkOrderBlock;
use App\Models\WorkOrderBlockTask;
use App\Models\WorkOrderUser;
use App\Models\WorkOrderBlockZone;
use App\Models\ElementType;

class WorkOrderController
{
    public function index($queryParams)
    {
        $current_contract_id = Session::get('current_contract');
        $work_orders = WorkOrder::findBy(['contract_id' => $current_contract_id]);

        View::render([
            'view' => 'Admin/WorkOrders',
            'title' => 'Órdenes de Trabajo',
            'layout' => 'Admin/AdminLayout',
            'data' => ['work_orders' => $work_orders],
        ]);
    }

    public function create($queryParams)
    {
        $task_types = TaskType::findAll();
        $users = User::findAll(['role' => 1]);
        $zones = Zone::findAll(['name' => 'not null']);
        $tree_types = TreeType::findAll();
        $element_types = ElementType::findAll();
        View::render([
            'view' => 'Admin/WorkOrder/Create',
            'title' => 'Nueva Orden de Trabajo',
            'layout' => 'Admin/AdminLayout',
            'data' => [
                'users' => $users,
                'zones' => $zones,
                'task_types' => $task_types,
                'tree_types' => $tree_types,
                'element_types' => $element_types,
            ],
        ]);
    }

    public function store($postData)
    {
        try {
            $work_order = new WorkOrder();
            $work_order->contract_id = Session::get('current_contract');
            $work_order->date = $postData['date'];
            $work_order->save();

            // Create user relationships
            foreach (explode(',', $postData['userIds']) as $userId) {
                $workOrderUser = new WorkOrderUser();
                $workOrderUser->work_order_id = $work_order->getId();
                $workOrderUser->user_id = $userId;
                $workOrderUser->save();
            }

            foreach ($postData['blocks'] as $blockData) {
                $block = new WorkOrderBlock();
                $block->work_order_id = $work_order->getId();
                $block->notes = $blockData['notes'];
                $block->save();

                foreach (explode(',', $blockData['zonesIds']) as $zoneId) {
                    $blockZone = new WorkOrderBlockZone();
                    $blockZone->work_orders_block_id = $block->getId();
                    $blockZone->zone_id = $zoneId;
                    $blockZone->save();
                }

                foreach ($blockData['tasks'] as $taskData) {
                    $task = new WorkOrderBlockTask();
                    $task->work_orders_block_id = $block->getId();
                    $task->task_id = $taskData['taskType'];
                    $task->tree_type_id = !empty($taskData['species']) ? $taskData['species'] : null;
                    $task->save();
                }
            }

            if ($work_order->getId()) {
                Session::set('success', 'Orden de Trabajo creada correctamente');
            } else {
                Session::set('error', 'La orden de trabajo no se pudo crear');
            }

            header('Location: /admin/work-orders');
            exit;
        } catch (\Throwable $th) {
            Session::set('error', $th->getMessage());
            header('Location: /admin/work-order/create');
            exit;
        }
    }

    public function edit($id, $queryParams)
    {
        $work_order = WorkOrder::find($id);
        if (!$work_order) {
            Session::set('error', 'Orden de trabajo no encontrada');
            header('Location: /admin/work-orders');
            exit;
        }

        $task_types = TaskType::findAll();
        $users = User::findAll(['role' => 1]);
        $zones = Zone::findAll(['name' => 'not null']);
        $tree_types = TreeType::findAll();
        $element_types = ElementType::findAll();

        View::render([
            'view' => 'Admin/WorkOrder/Edit',
            'title' => 'Editando Orden de Trabajo',
            'layout' => 'Admin/AdminLayout',
            'data' => [
                'work_order' => $work_order,
                'users' => $users,
                'zones' => $zones,
                'task_types' => $task_types,
                'tree_types' => $tree_types,
                'element_types' => $element_types,
            ],
        ]);
    }

    public function update($id, $postData)
    {
        try {
            $work_order = WorkOrder::find($id);

            if ($work_order) {
                $work_order->contract_id = Session::get('current_contract');
                $work_order->date = $postData['date'];
                $work_order->save();

                foreach ($work_order->users() as $user) {
                    $workOrderUser = WorkOrderUser::findBy(['work_order_id' => $work_order->getId(), 'user_id' => $user->getId()], true);
                    if ($workOrderUser) {
                        $workOrderUser->delete(true);
                    }
                }

                foreach ($work_order->blocks() as $block) {
                    foreach ($block->tasks() as $task) {
                        $task->delete(true);
                    }
                    foreach ($block->zones() as $zone) {
                        $blockZone = WorkOrderBlockZone::findBy(['work_orders_block_id' => $block->getId(), 'zone_id' => $zone->getId()], true);
                        if ($blockZone) {
                            $blockZone->delete(true);
                        }
                    }
                    $block->delete(true);
                }

                foreach (explode(',', $postData['userIds']) as $userId) {
                    $workOrderUser = new WorkOrderUser();
                    $workOrderUser->work_order_id = $work_order->getId();
                    $workOrderUser->user_id = $userId;
                    $workOrderUser->save();
                }

                foreach ($postData['blocks'] as $blockData) {
                    $block = new WorkOrderBlock();
                    $block->work_order_id = $work_order->getId();
                    $block->notes = $blockData['notes'];
                    $block->save();

                    foreach (explode(',', $blockData['zonesIds']) as $zoneId) {
                        $blockZone = new WorkOrderBlockZone();
                        $blockZone->work_orders_block_id = $block->getId();
                        $blockZone->zone_id = $zoneId;
                        $blockZone->save();
                    }

                    foreach ($blockData['tasks'] as $taskData) {
                        $task = new WorkOrderBlockTask();
                        $task->work_orders_block_id = $block->getId();
                        $task->task_id = $taskData['taskType'];
                        $task->element_type_id = $taskData['elementType'];
                        $task->tree_type_id = !empty($taskData['species']) ? $taskData['species'] : null;
                        $task->save();
                    }
                }

                Session::set('success', 'Orden de Trabajo actualizada correctamente');
            } else {
                Session::set('error', 'Orden de trabajo no encontrada');
            }

            header('Location: /admin/work-orders');
            exit;
        } catch (\Throwable $th) {
            Session::set('error', $th->getMessage());
            header("Location: /admin/work-order/$id/edit");
            exit;
        }
    }

    public function destroy($id, $queryParams)
    {
        $work_order = WorkOrder::find($id);

        if ($work_order) {
            foreach ($work_order->users() as $user) {
                $workOrderUser = WorkOrderUser::findBy(['work_order_id' => $work_order->getId(), 'user_id' => $user->getId()], true);
                if ($workOrderUser) {
                    $workOrderUser->delete();
                }
            }

            foreach ($work_order->blocks() as $block) {
                foreach ($block->tasks() as $task) {
                    $task->delete();
                }
                foreach ($block->zones() as $zone) {
                    $blockZone = WorkOrderBlockZone::findBy(['work_orders_block_id' => $block->getId(), 'zone_id' => $zone->getId()], true);
                    if ($blockZone) {
                        $blockZone->delete();
                    }
                }
                $block->delete();
            }

            $work_order->delete();
            Session::set('success', 'Orden de Trabajo eliminada correctamente');
        } else {
            Session::set('error', 'Orden de trabajo no encontrada');
        }

        header('Location: /admin/work-orders');
        exit;
    }
}
