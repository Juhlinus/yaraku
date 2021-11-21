<?php

namespace App\Models;

use App\Support\BookCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $visible = [
        'title',
        'author',
    ];

    public function scopeSortedOrLatest(Builder $query, array $sorting = []): Builder
    {
        $sorting = collect($sorting);

        if ($sorting->isEmpty()) {
            return $query->latest();
        }

        return $query->orderBy(
            $sorting->get('sort_by', 'id'), 
            $sorting->get('direction', 'asc'),
        );
    }

    public function scopeFilterBy(Builder $query, array $search = []): Builder
    {
        $search = collect($search);

        if ($search->isEmpty()) {
            return $query;
        }

        return $query->where(
            $search->get('column'), 
            'like', 
            '%' . $search->get('search') . '%'
        );
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new BookCollection($models);
    }
}
