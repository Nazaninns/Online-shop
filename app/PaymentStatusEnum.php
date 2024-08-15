<?php

namespace App;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case SUCCESSFUL = 'successful';
    case FAILED = 'failed';
}
