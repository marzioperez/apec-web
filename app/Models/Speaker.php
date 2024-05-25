<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Speaker extends Model implements Sortable {

    use HasFactory, SoftDeletes, SortableTrait;

    protected $fillable = [
        'name',
        'position',
        'company',
        'summary',
        'biography',
        'social_networks',
        'photo',
        'order'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    protected $casts = [
        'social_networks' => 'json',
        'order' => 'integer'
    ];
}
