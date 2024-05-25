<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Sponsor extends Model implements Sortable {

    use HasFactory, SoftDeletes, SortableTrait;

    protected $fillable = [
        'name',
        'logo',
        'description',
        'social_networks',
        'order',
        'category_sponsor_id'
    ];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    protected $casts = [
        'social_networks' => 'json',
        'order' => 'integer'
    ];

    public function category(): HasOne {
        return $this->hasOne(CategorySponsor::class, 'id', 'category_sponsor_id');
    }
}
