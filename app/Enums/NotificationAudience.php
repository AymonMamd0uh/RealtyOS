<?php

namespace App\Enums;

enum NotificationAudience: string
{
    case PLATFORM_ADMIN = 'platform_admin';

    case OWNER = 'owner';

    case MANAGER = 'manager';

    case AGENT = 'agent';
}