<?php

namespace App\Enum;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESSFUL = 'successful';
    case FAILED = 'failed';
}
