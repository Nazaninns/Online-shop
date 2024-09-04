<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    case PAID = 'paid';
    case PREPARING = 'preparing';
    case SHIPPING = 'shipping';
    case DELIVERED = 'delivered';
}
