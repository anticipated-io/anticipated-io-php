<?php

namespace AnticipatedIO;

class Result
{
    /**
     * @var int
     */
    private $_statusCode = 200;
    /**
     * @var boolean
     */
    private $_success = false;
    /**
     * @var \DateTime
     */
    private $_now = '';
    /**
     * @var string
     */
    private $_user = '';
    /**
     * @var string
     */
    private $_company = '';
    /**
     * @var \AnticipatedIO\Event
     */
    private $_event = null;
    /**
     * @var \AnticipatedIO\EventResponse[]
     */
    private $_responses = [];

    public function __construct($success = false, $statusCode = 400, $now = '', $user = '', $company = '', $event = null, $responses = [])
    {
        $this->setSuccess($success);
        $this->setStatusCode($statusCode);
        $this->setNow($now);
        $this->setUser($user);
        $this->setCompany($company);
        $this->setEvent($event);
        $this->setResponses($responses);
        return $this;
    }
    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->_statusCode;
    }
    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode): void
    {
        $this->_statusCode = $statusCode;
    }
    /**
     * @return bool
     */
    public function getSuccess(): bool
    {
        return $this->_success;
    }
    /**
     * @param bool $success
     */
    public function setSuccess($success): void
    {
        $this->_success = $success;
    }
    /**
     * @return \DateTime
     */
    public function getNow(): \DateTime
    {
        return $this->_now;
    }
    /**
     * @param \DateTime $now
     */
    public function setNow($now): void
    {
        $this->_now = $now;
    }
    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->_user;
    }
    /**
     * @param string $user
     */
    public function setUser($user): void
    {
        $this->_user = $user;
    }
    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->_company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company): void
    {
        $this->_company = $company;
    }
    /**
     * @return \AnticipatedIO\Event
     */
    public function getEvent(): \AnticipatedIO\Event
    {
        return $this->_event;
    }
    /**
     * @param \AnticipatedIO\Event $event
     */
    public function setEvent($event): void
    {
        $this->_event = $event;
    }
    /**
     * @param \AnticipatedIO\EventResponse[] $responses
     */
    public function setResponses($responses)
    {
        $this->_responses = $responses;
    }
    /**
     * @return \AnticipatedIO\EventResponse[]
     */
    public function getResponses(): array
    {
        return $this->_responses;
    }
}
