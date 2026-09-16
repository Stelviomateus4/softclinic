<?php

namespace App\Exceptions;

use Exception;

class PermissionDenied extends Exception
{
    public function __construct()
    {
        parent::__construct(__('ui.permission_denied'));
    }
}
