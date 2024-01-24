<?php

namespace Leuz\JitsiBundle;

use Leuz\JitsiBundle\Entity\Features;
use Leuz\JitsiBundle\Entity\Payload;
use Leuz\JitsiBundle\Entity\User;

class Jitsi
{
    public function __construct(
        private JitsiJwsBuilder $jitsiJwsBuilder
    )
    {
        
    }

    public function buildToken(User $user, Features $features, Payload $payload) 
    {
        $token = $this->jitsiJwsBuilder
        ->setUser($user)
        ->setFeatures($features)
        ->setPayload($payload)
        ->build();

        return $token;
    }
}