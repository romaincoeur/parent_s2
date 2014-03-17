<?php

namespace Pn\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PnUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
