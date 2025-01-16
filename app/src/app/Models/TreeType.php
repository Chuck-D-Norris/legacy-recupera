<?php

namespace App\Models;

class TreeType extends BaseModel
{
    public string $family;

    public string $genus;

    public string $species;

    protected static function getTableName(): string
    {
        return 'tree_types';
    }

    protected static function mapDataToModel($data): TreeType
    {
        $tree_type = new self;
        $tree_type->id = $data['id'];
        $tree_type->family = $data['family'];
        $tree_type->genus = $data['genus'];
        $tree_type->species = $data['species'];
        $tree_type->created_at = $data['created_at'];
        $tree_type->updated_at = $data['updated_at'];
        $tree_type->deleted_at = $data['deleted_at'];

        return $tree_type;
    }

    public function elements(): array
    {
        return $this->hasMany(Element::class, 'tree_type_id');
    }
}
