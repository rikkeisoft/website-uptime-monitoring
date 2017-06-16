<?php

namespace App\Contracts;

/**
 * Defined tables' name.
 */
class Constants
{
    const STATUS_PENDING = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;
    const DELAYED_INTERVAL = 10; // In seconds
    const DEFAULT_PER_PAGE = 20;
    const NUMBER_OF_MILESTONES = 10;
}
