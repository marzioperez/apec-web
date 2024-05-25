<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class CategorySponsor extends Model implements Sortable {

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
        'order' => 'integer'
    ];

    public function sponsors(): HasMany {
        return $this->hasMany(Sponsor::class, 'category_sponsor_id', 'id')->ordered();
    }
}
