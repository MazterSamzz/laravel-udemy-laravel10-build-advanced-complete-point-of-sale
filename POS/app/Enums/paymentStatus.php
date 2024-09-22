<?php

namespace App\Enums;

enum SalesStatus: int
{
    case Unpaid = 1;     // Awaiting payment
    case NotYet = 2;     // Not Due Yet
    case Overdue = 3;    // Overdue
    case Authorized = 4; // Authorized by finiancial institution but not yet paid
    case Paid = 5;       // Fully paid
    case Refunding = 6;  // Waiting for Refund
    case Refunded = 7;   // Fully Refunded
    case Canceled = 8;   // Canceled payment
}
