<?php

namespace App\DTO;

class MessageProviderResponse
{
    private string $uuid;
    private bool $status = false;
    private ?string $messageId = null;
    private \DateTime $sentAt;

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     * @return MessageProviderResponse
     */
    public function setStatus(bool $status): MessageProviderResponse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessageId(): ?string
    {
        return $this->messageId;
    }

    /**
     * @param mixed $messageId
     * @return MessageProviderResponse
     */
    public function setMessageId(?string $messageId): MessageProviderResponse
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    /**
     * @param \DateTime $sentAt
     * @return MessageProviderResponse
     */
    public function setSentAt(\DateTime $sentAt): MessageProviderResponse
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return MessageProviderResponse
     */
    public function setUuid(string $uuid): MessageProviderResponse
    {
        $this->uuid = $uuid;

        return $this;
    }
}
