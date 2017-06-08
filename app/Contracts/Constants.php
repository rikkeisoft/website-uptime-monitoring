<?php
namespace App\Contracts;

/**
 * Defined tables' name
 *
 * @package App\Contracts
 */
class Constants
{
    const CHECK_PENDING = 0;
    const CHECK_SUCCESS = 1;
    const CHECK_FAILED = 2;
    const TIME_DELAY_SENSITIVITY = 10;
    const LIMIT_PAGINATE = 20;
    const LIMIT_LIST_REDIS = 10;
}
