<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $email_address
 * @property int $created_by
 */
class EmailAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'email_address',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $email_address) {
            if (auth()->check() && empty($email_address->created_by)) {
                $email_address->created_by = auth()->user()->id;
            }
        });
    }
}
