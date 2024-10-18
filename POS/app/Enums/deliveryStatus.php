<?php

namespace App\Enums;

enum DeliveryStatus: int
{
    case Pending = 1;            // Created by customer
    case Confirmed = 2;          // Confirmed by admin
    case Canceled = 3;           // Canceled order
    case PartiallyShipped = 4;   // Partially shipped
    case PartiallyDelivered = 5; // Partially delivered
    case Shipped = 6;            // Fully Shipped
    case Delivered = 7;          // Fully Delivered
}
