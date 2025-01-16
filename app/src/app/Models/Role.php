<?php

namespace App\Models;

class Role extends BaseModel
{
    public string $name;

    protected static function getTableName(): string
    {
        return 'roles';
    }

    protected static function mapDataToModel($data): Role
    {
        $role = new self;
        $role->id = $data['id'];
        $role->name = $data['name'];
        $role->created_at = $data['created_at'];
        $role->updated_at = $data['updated_at'];
        $role->deleted_at = $data['deleted_at'];

        return $role;
    }
}
