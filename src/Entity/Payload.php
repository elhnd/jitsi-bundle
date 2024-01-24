<?php

namespace Leuz\JitsiBundle\Entity;

class Payload 
{
    private string $iss;
    private string $aud;
    private int    $exp;
    private int    $nbf;
    private string $room = '*';
    private string $sub = 'vpaas-magic-cookie-3b3fbcd75def45c3928b8f7f9ff902a5'; // => APP_ID => vpaas-magic-cookie-3b3fbcd75def45c3928b8f7f9ff902a5
    private array  $context;

    public function setIss(string $iss): self
    {
        $this->iss = $iss;
        return $this;
    }

    public function setAud(string $aud): self
    {
        $this->aud = $aud;
        return $this;
    }

    public function setExp(int $exp): self
    {
        $this->exp = time() + $exp;
        return $this;
    }

    public function setNBF(bool $nbf): self
    {
        $this->nbf = time() + $nbf;
        return $this;
    }

    public function setRoom(string $room): self
    {
        $this->room = $room;
        return $this;
    }

    public function setSub(string $sub): self
    {
        $this->sub = $sub;
        return $this;
    }

    public function setContext(array $context): self
    {
        $this->context = $context;
        return $this;
    }

    public function toArray()
    {
        return [
            'iss' => $this->iss,
            'aud' => $this->aud,
            'exp' => $this->exp,
            'nbf' => $this->nbf,
            'room' => $this->room,
            'sub' => $this->sub,
            'context' => $this->context
        ];
    }

}