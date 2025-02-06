<?php

namespace App\Models;

class Pokemon extends BaseModel
{
    public ?int $id; 
    public string $name;
    public ?string $type;
    public int $points;

    protected static function getTableName(): string
    {
        return 'pokemon';
    }

    protected static function mapDataToModel($data): Pokemon
    {
        $pokemon = new self();
        $pokemon->id = $data['id'] ?? null; 
        $pokemon->name = $data['name'];
        $pokemon->type = $data['type'] ?? null; 
        $pokemon->points = $data['points'] ?? 0;

        return $pokemon;
    }
}
