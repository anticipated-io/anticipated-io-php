<?php

namespace AnticipatedIO;

class Event
{
    /**
     * @var string
     */
    protected $_id = '';
    /**
     * @var string
     */
    protected $_company = '';
    /**
     * @var \DateTime
     */
    protected $_when = null;
    /**
     * @var 'json'|'xml'|'sqs'
     */
    protected $_type = 'json';
    /**
     * @var EventDetails
     */
    protected $_details = null;
    /**
     * @var bool
     */
    protected $_processed = false;
    /**
     * @var bool
     */
    protected $_deleted = false;
    /**
     * @var \DateTime
     */
    protected $_created = null;

    public function __construct($id = '', $company = '', $when = null, $type = 'json', $details = null)
    {
        $this->setId($id);
        $this->setCompany($company);
        $this->setWhen($when);
        $this->setType($type);
        $this->setDetails($details);
    }
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }
    /**
     * @param string $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
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
     * @return \DateTime
     */
    public function getWhen(): \DateTime
    {
        return $this->_when;
    }
    /**
     * @param \DateTime $when
     */
    public function setWhen($when): void
    {
        $this->_when = $when;
    }
    /**
     * @return 'json'|'xml'|'sqs'
     */
    public function getType()
    {
        return $this->_type;
    }
    /**
     * @param 'json'|'xml'|'sqs' $type
     */
    public function setType($type): void
    {
        $this->_type = $type;
    }

    /**
     * @return object
     */
    public function getDetails(): object
    {
        return $this->_details;
    }
    /**
     * @param object $details
     */
    public function setDetails($details): void
    {
        $this->_details = $details;
    }
    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->_created;
    }
    /**
     * @param \DateTime $id
     */
    public function setCreated($dte): void
    {
        $this->_created = $dte;
    }
    /**
     * @return boolean
     */
    public function getProcessed(): bool
    {
        return $this->_processed;
    }
    /**
     * @param boolean $processed
     */
    public function setProcessed($processed): void
    {
        $this->_processed = $processed;
    }
    /**
     * @return boolean
     */
    public function getDeleted(): bool
    {
        return $this->_deleted;
    }
    /**
     * @param boolean $processed
     */
    public function setDeleted($deleted): void
    {
        $this->_deleted = $deleted;
    }
}
