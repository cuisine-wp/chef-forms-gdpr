<?php

namespace ChefFormsGdpr\Facades;

use ChefFormsGdpr\Contracts\Facade;

class Processor extends Facade
{

    /**
     * Return the igniter service key responsible for the Processor class.
     * The key must be the same as the one used in the assigned
     * igniter service.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'processor';
    }

}
