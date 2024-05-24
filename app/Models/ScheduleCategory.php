<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ScheduleCategory extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'name',
        'order'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    protected $casts = [
        'show' => 'boolean',
        'order' => 'integer'
    ];

    public function days(): HasMany {
        return $this->hasMany(ScheduleDay::class, 'schedule_category_id', 'id')->ordered();
    }
}
