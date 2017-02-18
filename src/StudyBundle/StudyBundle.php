<?php

namespace StudyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StudyBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
