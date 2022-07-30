<?php

namespace OmeneJoseph\DynamicEnv;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Omenejoseph\DynamicEnv\Skeleton\SkeletonClass
 */
class DynamicEnvFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dynamic-env';
    }
}
