<?php

namespace EI\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EIUserBundle extends Bundle
{
    public function getParent()
        {
          return 'FOSUserBundle';
        }
}
