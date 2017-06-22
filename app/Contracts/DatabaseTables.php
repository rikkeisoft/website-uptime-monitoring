<?php

namespace App\Contracts;

/**
 * Defined tables' name.
 */
class DatabaseTables
{
    const USERS = 'users';
    const PASSWORD_RESETS = 'password_resets';
    const WEBSITES = 'websites';
    const ALERT_GROUPS = 'alert_groups';
    const ALERT_METHODS = 'alert_methods';
    const MONITORS = 'monitors';
    const ALERT_METHOD_ALERT_GROUP = 'alert_method_alert_group';
}
