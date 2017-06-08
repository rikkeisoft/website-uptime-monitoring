<?php
namespace App\Contracts;

/**
 * Defined tables' name
 *
 * @package App\Contracts
 */
class DBTable
{
    const USER = 'users';
    const WEBSITE = 'websites';
    const ALERT_GROUP = 'alert_groups';
    const ALERT_METHOD = 'alert_methods';
    const MONITOR = 'monitors';
    const ALERT_METHOD_ALERT_GROUP = 'alert_method_alert_group';
    const PASSWORD_RESET = 'password_resets';
}
