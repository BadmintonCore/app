<?php

namespace Vestis\Database\Models;

enum OrderStatus: string
{
    case PaymentPending = 'Zahlung ausstehend';
    case Denied = 'Auftrag abgelehnt';
    case InProgress = 'In Bearbeitung';
    case Canceled = 'Abgelehnt';
    case Shipped = 'Versandt';
}
