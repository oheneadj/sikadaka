<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    use LogsActivity;


    protected $fillable = [
        'amount',
        'payment_type',
        'purpose',
        'month',
        'year',
        'contributor_id',
        'user_id',
        'project_id'
    ];

    protected $with = ['contributor', 'payment_made_to'];

    protected $casts = [
        'amount' => 'integer'
    ];

    /**
     * contributor
     *
     * @return BelongsTo
     */
    public function contributor(): BelongsTo
    {
        return $this->belongsTo(Contributor::class);
    }



    /**
     * payment_made_to
     *
     * @return BelongsTo
     */
    public function payment_made_to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * project
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
        // Chain fluent methods for configuration options
    }
}
