<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\LeadStatus;

class LeadActivity extends Model
{
    protected $fillable = [
        'lead_id',
        'user_id',

        'type',

        'notes',

        'activity_date',
    ];

    protected function casts(): array
    {
        return [
            'type' => ActivityType::class,

            'activity_date' => 'datetime',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected static function booted(): void
    {
        static::created(function (LeadActivity $activity) {

            $lead = $activity->lead;

            if (! $lead) {
                return;
            }

            match ($activity->type) {

                ActivityType::CALL =>
                $lead->update([
                    'status' => LeadStatus::CONTACTED,
                ]),

                ActivityType::MEETING =>
                $lead->update([
                    'status' => LeadStatus::QUALIFIED,
                ]),

                ActivityType::VIEWING =>
                $lead->update([
                    'status' => LeadStatus::VIEWING,
                ]),

                ActivityType::NEGOTIATION =>
                $lead->update([
                    'status' => LeadStatus::NEGOTIATION,
                ]),

                ActivityType::WON =>
                $lead->update([
                    'status' => LeadStatus::WON,
                ]),

                ActivityType::LOST =>
                $lead->update([
                    'status' => LeadStatus::LOST,
                ]),

                default => null,
            };
        });
    }
}
