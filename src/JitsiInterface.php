<?php

namespace Leuz\JitsiBundle;

use Leuz\JitsiBundle\Entity\Features;
use Leuz\JitsiBundle\Entity\Payload;
use Leuz\JitsiBundle\Entity\User;

interface JitsiInterface
{
    public function buildToken(User $user, Features $features, Payload $payload);
}