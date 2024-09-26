<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Unpaid = 1;     // Awaiting payment
    case NotYet = 2;     // Not Due Yet
    case Overdue = 3;    // Overdue
    case Canceling = 4;   // User requesting cancelation
    case Canceled = 5;   // Approved payment cancelation
    case Authorized = 6; // Authorized by finiancial institution but not yet paid
    case Paid = 7;       // Fully paid
    case Refunding = 8;  // User requesting refund
    case Refunded = 9;   // Fully Refunded
}
