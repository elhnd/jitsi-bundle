<?php

namespace Leuz\JitsiBundle\Entity;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $avatarURL;
    private bool   $isModerator;

    public function setId(string $id) : self 
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    public function setAvatarURL(string $avatarURL) : self
    {
        $this->avatarURL = $avatarURL;
        return $this;
    }

    public function setIsModerator(string $isModerator) : self
    {
        $this->isModerator = $isModerator;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'moderator' => $this->isModerator ? "true" : "false",
            'email' => $this->email,
            'name' => $this->name,
            'avatar' => $this->avatarURL,
            'id' => $this->id
        ];
    }
}