<?php

namespace Roberts\Leads\Enums;

use MabeEnum\Enum;

/**
 * @psalm-immutable
 */
final class LeadStatus extends Enum
{
    const OPEN = 'Open';
    const PARTIAL = 'Partial';
    const RECEIVED = 'Received';
    const VALIDATED = 'Validated';
    const PROCESSING = 'Processing';
    const INACTIVE = 'Inactive';
    const CLOSED = 'Closed';
}
