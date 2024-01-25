<?php

namespace Leuz\JitsiBundle;

use Leuz\JitsiBundle\Entity\Features;
use Leuz\JitsiBundle\Entity\Payload;
use Leuz\JitsiBundle\Entity\User;

class Jitsi implements JitsiInterface
{
    public function __construct(
        private JitsiJwsBuilder $jitsiJwsBuilder
    )
    {}

    public function buildToken(User $user, Features $features, Payload $payload): string
    {
        $token = $this->jitsiJwsBuilder
        ->setUser($user)
        ->setFeatures($features)
        ->setPayload($payload)
        ->build();

        return $token;
    }
}