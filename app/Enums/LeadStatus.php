<?php

namespace App\Enums;

enum LeadStatus: string
{
    case NEW = 'new';

    case CONTACTED = 'contacted';

    case QUALIFIED = 'qualified';

    case VIEWING = 'viewing';

    case NEGOTIATION = 'negotiation';

    case WON = 'won';

    case LOST = 'lost';
}