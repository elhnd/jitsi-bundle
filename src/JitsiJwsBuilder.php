<?php

namespace Leuz\JitsiBundle;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\JWK;
use Jose\Component\KeyManagement\JWKFactory;
use Jose\Component\Signature\Algorithm\RS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Leuz\JitsiBundle\Entity\Features;
use Leuz\JitsiBundle\Entity\Payload;
use Leuz\JitsiBundle\Entity\User;

class JitsiJwsBuilder
{
    const ALGO_SIGN = 'RS256';
    const TYPE_SIGN = 'JWT';

    private User        $user;
    private Features    $features;
    private Payload     $payload;

    public function __construct(
        private string $apiKey,
        private string $sub,
        private string $iss,
        private string $aud
    )
    {}

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setFeatures(Features $features): self
    {
        $this->features = $features;
        return $this;
    }

    public function setPayload(Payload $payload): self
    {
        $payload
            ->setIss($this->iss)
            ->setAud($this->aud)
            ->setSub($this->sub);

        $this->payload = $payload;

        $this->payload->setContext([
            'user' => $this->user->toArray(),
            'features' => $this->features->toArray()
        ]);
        return $this;
    }

    private function jwk(): JWK
    {
        return JWKFactory::createFromKeyFile(__DIR__."/rsa-private.key");;
    }

    private function algorithm(): AlgorithmManager 
    {
        return new AlgorithmManager([
            new RS256()
        ]);
    }

    private function jwsBuilder(): JWSBuilder
    {
        return new JWSBuilder($this->algorithm());
    }

    private function composePayload(): string
    {
        return json_encode($this->payload->toArray());
    }

    public function build(): string
    {
        $jws = $this->jwsBuilder()
        ->create()
        ->withPayload($this->composePayload())
        ->addSignature($this->jwk(), [
            'alg' => self::ALGO_SIGN,
            'kid' => $this->apiKey,
            'typ' => self::TYPE_SIGN
        ])
        ->build();

        $serializer = new CompactSerializer();
        return $serializer->serialize($jws, 0);
    }
}
