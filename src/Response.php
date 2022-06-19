<?php

namespace AnticipatedIO;

class Response
{
    /**
     * @var int
     */
    protected $_statusCode = 200;
    /**
     * @var string[]
     */
    protected $_headers = [];
    /**
     * @var string
     */
    protected $_body;
    /**
     * @var \DateTime
     */
    protected $_date;
    /**
     * @param object $object
     */
    public function __construct($statusCode, $headers, $body, $date)
    {
        $this->_statusCode = $statusCode;
        $this->_headers = $headers;
        $this->_body = $body;
        $this->_date = $date;
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
    public function setMethod($statusCode): void
    {
        return $this->statusCode;
    }
    /**
     * @return \DateTime
     */
    public function getDateTime(): \DateTime
    {
        return $this->_date;
    }
    /**
     * @param \DateTime $dte
     */
    public function setDateTime($dte): void
    {
        $this->_date = $dte;
    }
    /**
     * @template T
     * @return T
     */
    public function getDocument(): object
    {
        return $this->_document;
    }
    /**
     * @template T
     * @param T $document
     */
    public function setDocument($document): void
    {
        $this->_document = $document;
    }
    /**
     * @return string[]
     */
    public function getHeaders(): array
    {
        return $this->_headers;
    }
    /**
     * @param string[] $headers
     */
    public function setHeaders($headers): void
    {
        $this->_headers = $headers;
    }
}
