<?php

namespace Vestis\Database\Models;

enum OrderStatus: string
{
    case PaymentPending = 'Zahlung ausstehend';
    case InProgress = 'In Bearbeitung';
    case Canceled = 'Auftrag storniert';
    case Denied = 'Auftrag abgelehnt';
    case Shipped = 'Versandt';
}
