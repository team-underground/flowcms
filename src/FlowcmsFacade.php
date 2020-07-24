<?php

namespace Flowcms\Flowcms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Flowcms\Flowcms\Skeleton\SkeletonClass
 */
class FlowcmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'flowcms';
    }
}
