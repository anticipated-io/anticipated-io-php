<?php

namespace AnticipatedIO;

class EventDetails
{
    /**
     * @var 'post'|'get'|'put'|'delete'
     */
    protected $_method = 'post';
    /**
     * @var string[]
     */
    protected $_headers = [];
    /**
     * @var string
     */
    protected $_url;
    /**
     * @var object
     */
    protected $_document;

    /**
     * @param object $object
     */
    public function __construct($object = null)
    {
        $this->_url = $object->url;
        $this->_document = $object->document;
        $this->_method = $object->method;
        $this->_headers = $object->headers;
        return $this;
    }
    /**
     * @return 'post'|'get'|'put'|'delete'
     */
    public function getMethod()
    {
        return $this->_method;
    }
    /**
     * @param 'post'|'get'|'put'|'delete' $method
     */
    public function setMethod($method): void
    {
        $this->_method = $method;
    }
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_url;
    }
    /**
     * @param string $url
     */
    public function setUrl($url): void
    {
        $this->_url = $url;
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
     * @param object $document
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
