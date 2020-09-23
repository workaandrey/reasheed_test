<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereNameAndSize(string $name, int $size)
 */
class Proposal extends Model
{
    use HasFactory;

    public function scopeWhereNameAndSize(Builder $builder, string $name, int $size)
    {
        return $builder
            ->where('name', $name)
            ->where('size', $size);
    }
}
