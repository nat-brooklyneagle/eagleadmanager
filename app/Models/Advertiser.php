<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $team_id
 * @property string $first_name
 * @property string $last_name
 * @property mixed $email_addresses
 * @property int $id
 */
class Advertiser extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'team_id',
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

    /** @noinspection PhpUnused */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim("$this->first_name $this->last_name"),
        );
    }

    public function email_addresses(): BelongsToMany
    {
        return $this->belongsToMany(EmailAddress::class, 'advertiser_email_addresses');
    }
}
