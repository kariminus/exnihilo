<?php

namespace ExNihilo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExNihiloUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
