<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $fillable = [
        'api_name', 'local_name', 'parent_id'
    ];

    protected $appends = [
        'name'
    ];

    /**
     * Get the name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ($this->local_name) ?: $this->api_name,
        );
    }

    /**
     * For get parent relationship data
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * For get all children relationship data
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public static function addEditFromCmd($name, $parentId = 0)
    {
        $record = self::firstOrNew(['api_name' => $name]);
        $record->parent_id = $parentId;
        $record->save();
        return $record->id;
    }

}
