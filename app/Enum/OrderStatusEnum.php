<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    case PENDING = 'pending';
    case SHIPPED = 'shipped';
    case CANCELLED = 'cancelled';
}
