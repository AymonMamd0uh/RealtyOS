<?php

namespace App\Console\Commands;

use App\Models\Lead;
use Illuminate\Console\Command;
use App\Services\NotificationService;

class SendFollowUpOverdueNotifications extends Command
{
    protected $signature = 'notifications:followups-overdue';

    protected $description = 'Send overdue follow up notifications';

    public function handle(
        NotificationService $notificationService,
    ): int {

        $leads = Lead::query()

            ->whereNotNull('next_follow_up_at')

            ->whereNull('follow_up_overdue_notified_at')

            ->where('follow_up_completed', false)

            ->where(
                'next_follow_up_at',
                '<=',
                now()->subHour(),
            )

            ->with('assignedTo')

            ->get();

        foreach ($leads as $lead) {

            $notificationService
                ->followUpOverdue($lead);

            $lead->update([

                'follow_up_overdue_notified_at' => now(),

            ]);
        }

        $this->info(
            "Sent {$leads->count()} overdue notifications."
        );

        return self::SUCCESS;
    }
}
