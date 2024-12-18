<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ScheduleDay extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'title',
        'show',
        'order',
        'schedule_category_id'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    protected $casts = [
        'show' => 'boolean',
        'order' => 'integer'
    ];

    public function activities(): HasMany {
        return $this->hasMany(ScheduleDayActivity::class, 'schedule_day_id', 'id')->ordered();
    }
}
