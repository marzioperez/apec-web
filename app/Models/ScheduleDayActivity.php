<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ScheduleDayActivity extends Model implements Sortable {

    use SoftDeletes, SortableTrait;

    protected $fillable = [
        'title',
        'content',
        'start',
        'end',
        'schedule_day_id',
        'order'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];
    protected $casts = [
        'order' => 'integer'
    ];
}
