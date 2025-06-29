<?php

//Autor(en): Mathis Burger

namespace Vestis\Database\Models;

/**
 * Der Status einer Bestellung / Auftrages
 */
enum OrderStatus: string
{
    case PaymentPending = 'Zahlung ausstehend';
    case InProgress = 'In Bearbeitung';
    case Canceled = 'Auftrag storniert';
    case Denied = 'Auftrag abgelehnt';
    case Shipped = 'Versandt';
}
//Autor(en): Mathis Burger
