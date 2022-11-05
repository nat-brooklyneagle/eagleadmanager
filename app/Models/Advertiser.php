<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    protected $appends = [
        'full_name'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $advertiser) {
            if (auth()->check() && empty($advertiser->created_by)) {
                $advertiser->created_by = auth()->user()->id;
            }
        });
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("{$this->first_name} {$this->last_name}"),
        );
    }
}
