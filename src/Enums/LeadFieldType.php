<?php

namespace Roberts\Leads\Enums;

use MabeEnum\Enum;

/**
 * @psalm-immutable
 */
final class LeadFieldType extends Enum
{
    const TEXT = 'text';
    const NUMBER = 'number';
    const TEXTAREA = 'textarea';
}
