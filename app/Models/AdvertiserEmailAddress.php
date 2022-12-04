<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdvertiserEmailAddress extends Pivot
{
    protected $table = "advertiser_email_addresses";

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $advertiser_email_address) {
            if (auth()->check() && empty($advertiser_email_address->created_by)) {
                $advertiser_email_address->created_by = auth()->user()->id;
            }
        });
    }

    public function email_address(): BelongsTo
    {
        return $this->belongsTo(EmailAddress::class);
    }
}
