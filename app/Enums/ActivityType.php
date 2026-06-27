<?php

namespace App\Enums;

enum ActivityType: string
{
    case CALL = 'call';

    case WHATSAPP = 'whatsapp';

    case MEETING = 'meeting';

    case VIEWING = 'viewing';

    case EMAIL = 'email';

    case NOTE = 'note';

    case NEGOTIATION = 'negotiation';

    case WON = 'won';

    case LOST = 'lost';
}
