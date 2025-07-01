<?php

/**
 * This file is part of the vestis. webshop ecosystem
 *
 * © 2025 Mathis Burger, Lasse Hoffmann, Lennart Moog
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
