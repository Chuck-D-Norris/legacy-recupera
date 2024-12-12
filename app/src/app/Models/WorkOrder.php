<?php

namespace App\Models;

class WorkOrder extends BaseModel
{
    public ?int $contract_id;

    protected static function getTableName(): string
    {
        return 'work_orders';
    }

    protected static function mapDataToModel($data): WorkOrder
    {
        $work_order = new self();
        $work_order->id = $data['id'];
        $work_order->contract_id = $data['contract_id'];
        $work_order->created_at = $data['created_at'];
        $work_order->updated_at = $data['updated_at'];
        $work_order->deleted_at = $data['deleted_at'];

        return $work_order;
    }

    public function report(): WorkReport
    {
        return $this->hasOne(WorkReport::class, 'id');
    }

    public function contract(): Contract
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'work_order_id', 'id');
    }
}
