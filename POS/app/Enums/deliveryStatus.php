<?php

namespace App\Enums;

enum SalesStatus: int
{
    case Pending = 1;            // Created by customer
    case Confirmed = 2;          // Confirmed by admin
    case PartiallyShipped = 3;   // Partially shipped
    case PartiallyDelivered = 4; // Partially delivered
    case Shipped = 5;            // Fully Shipped
    case Canceled = 6;           // Canceled order
    case Delivered = 7;          // Fully Delivered
}
