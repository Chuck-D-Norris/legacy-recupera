<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\View;
use App\Models\WorkOrder;


class WorkOrderController
{
    public function index($queryParams)
    {
        $workOrders = WorkOrder::findAll();
        View::render([
            'view' => 'WorkOrders',
            'title' => 'Manage Orders',
            'layout' => 'MainLayout',
            'data' => ['workOrders' => $workOrders],
        ]);
        Session::remove('success');
    }

    public function create($queryParams)
    {
        $workOrders = WorkOrder::findAll();
        View::render([
            'view' => 'WorkOrder/Create',
            'title' => 'Add Order',
            'layout' => 'MainLayout',
            'data' => ['workOrders' => $workOrders],
        ]);
    }

    public function store($postData)
    {
    }

    public function edit($id, $queryParams)
    {
        $order = WorkOrder::find($id);
        View::render([
            'view' => 'Order/Edit',
            'title' => 'Edit Order',
            'layout' => 'MainLayout',
            'data' => ['order' => $order],
        ]);
    }

    public function update($id, $postData)
    {
        $order = WorkOrder::find($id);

        $order->save();

        Session::set('success', 'Order updated successfully');

        header('Location: /orders');
    }

    public function destroy($id, $queryParams)
    {
        $order = WorkOrder::find($id);
        $order->delete();

        Session::set('success', 'Order deleted successfully');

        header('Location: /orders');
    }
}
