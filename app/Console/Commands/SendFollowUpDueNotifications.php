<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use App\Services\NotificationService;

class SendFollowUpDueNotifications extends Command
{
    protected $signature = 'notifications:followups-due';

    protected $description = 'Send follow up due notifications';

    public function handle(
        NotificationService $notificationService,
    ): int {

        $leads = Lead::query()

            ->whereNotNull('next_follow_up_at')

            ->whereNull('follow_up_due_notified_at')

            ->where('follow_up_completed', false)

            ->where(
                'next_follow_up_at',
                '<=',
                now(),
            )

            ->with('assignedTo')

            ->get();

        foreach ($leads as $lead) {

            $notificationService
                ->followUpDue($lead);

            $lead->update([

                'follow_up_due_notified_at' => now(),

            ]);
        }

        $this->info(
            "Sent {$leads->count()} follow up due notifications."
        );

        return self::SUCCESS;
    }
}
