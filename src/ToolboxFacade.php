<?php

namespace Lemaur\Toolbox;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lemaur\Toolbox\Toolbox
 */
class ToolboxFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'toolbox';
    }
}
