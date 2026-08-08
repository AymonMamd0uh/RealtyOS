<?php

namespace App\Enums;

enum NotificationType: string
{
    /*
    |--------------------------------------------------------------------------
    | Lead Notifications
    |--------------------------------------------------------------------------
    */

    case LEAD_ASSIGNED = 'lead_assigned';
    case LEAD_REASSIGNED = 'lead_reassigned';

    case LEAD_CREATED = 'lead_created';

    case LEAD_UPDATED = 'lead_updated';

    case LEAD_WON = 'lead_won';

    case LEAD_LOST = 'lead_lost';

    /*
    |--------------------------------------------------------------------------
    | Follow Up Notifications
    |--------------------------------------------------------------------------
    */

    case FOLLOW_UP_DUE = 'follow_up_due';

    case FOLLOW_UP_OVERDUE = 'follow_up_overdue';

    case FOLLOW_UP_COMPLETED = 'follow_up_completed';

    /*
    |--------------------------------------------------------------------------
    | Property Notifications
    |--------------------------------------------------------------------------
    */

    case PROPERTY_CREATED = 'property_created';

    case PROPERTY_UPDATED = 'property_updated';

    case PROPERTY_ASSIGNED = 'property_assigned';

    /*
    |--------------------------------------------------------------------------
    | Subscription Notifications
    |--------------------------------------------------------------------------
    */

    case SUBSCRIPTION_EXPIRING = 'subscription_expiring';

    case SUBSCRIPTION_EXPIRED = 'subscription_expired';

    case SUBSCRIPTION_RENEWED = 'subscription_renewed';

    /*
    |--------------------------------------------------------------------------
    | Company Notifications
    |--------------------------------------------------------------------------
    */

    case USER_JOINED = 'user_joined';

    case USER_INVITED = 'user_invited';
}