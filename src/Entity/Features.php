<?php

namespace Leuz\JitsiBundle\Entity;

class Features
{
    private bool $isLiveStreaming;
    private bool $isRecording;
    private bool $isOutboundCall;
    private bool $isTranscription;

    public function setIsLiveStreaming(bool $isLiveStreaming): self
    {
        $this->isLiveStreaming = $isLiveStreaming;
        return $this;
    }

    public function setIsRecording(bool $isRecording): self
    {
        $this->isRecording = $isRecording;
        return $this;
    }

    public function setIsOutboundCall(bool $isOutboundCall): self
    {
        $this->isOutboundCall = $isOutboundCall;
        return $this;
    }

    public function setIsTranscription(bool $isTranscription): self
    {
        $this->isTranscription = $isTranscription;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'recording' => $this->isRecording ? "true" : "false",
            'livestreaming' => $this->isLiveStreaming ? "true" : "false",
            'transcription' => $this->isTranscription ? "true" : "false",
            'outbound-call' => $this->isOutboundCall ? "true" : "false"
        ];
    }
}