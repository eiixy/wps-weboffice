<?php

namespace Eiixy\WebOffice\Models;

use Illuminate\Database\Eloquent\Model;

class WebOfficeResource extends Model
{
    protected $table = 'web_office_resources';
    protected $guarded = [];


    public function resourceable()
    {
        return $this->morphTo();
    }

    public function scopeWhereMorph($query, string $type, int $id)
    {
        return $query->where([
            'resourceable_type' => $type,
            'resourceable_id' => $id
        ]);
    }

    public static function create($type, $id, $data)
    {
        return static::query()->create(array_merge($data, [
            'resourceable_type' => $type,
            'resourceable_id' => $id
        ]));
    }
}
