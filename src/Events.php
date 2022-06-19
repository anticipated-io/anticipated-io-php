<?php

namespace AnticipatedIO;

use Exception;

class Events
{
    private $_key = '';

    public function __construct($config)
    {
        $this->applyConfig($config);
    }

    private function applyConfig($config)
    {
        if (isset($config['key'])) {
            $this->_key = $config['key'];
        }
    }

    private function create($data)
    {
        $payload = json_encode($data);

        $ch = curl_init('https://dev-api.anticipated.io/v1/event');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($payload),
                'x-api-key: ' . $this->_key
            ]
        );

        $result = json_decode(curl_exec($ch));
        $statusCode = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));
        curl_close($ch);

        if ($statusCode === 200) {
            return new Result(
                $result->request->id !== '',
                $statusCode,
                new \DateTime($result->now),
                $result->context->user,
                $result->context->company,
                new Event(
                    $result->event->id,
                    $result->event->company,
                    new \DateTime($result->event->when),
                    $result->event->type,
                    new EventDetails($result->event->details)
                ),
                []
            );
        }

        return new Result(
            false,
            $statusCode
        );
    }

    /**
     * @param $when \DateTime|string when to fire the event
     * @param $url string URL to call when the webhook event fires
     * @param $method string either 'get', 'post', 'delete' or 'put' (verb) of the webhook event
     * @param $document object document to send with the request (is not sent if 'get' is the method used)
     * @param $config array configuration updates or to use for this call
     * @return Result
     * @throws Exception
     */
    public function createJson($when, $url, $method, $document, $headers = [], $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }

        return $this->create([
            'when' => is_string($when) ? $when : $when->format('Y-m-d H:i:s'),
            'type' => 'json',
            'details' => [
                'url' => $url,
                'method' => $method,
                'document' => $document,
                'headers' => $headers
            ]
        ]);
    }


    /**
     * @param $when \DateTime when to fire the event
     * @param $url string URL to call when the webhook event fires
     * @param $method string either 'get', 'post', 'delete' or 'put' (verb) of the webhook event
     * @param $document object document to send with the request (is not sent if 'get' is the method used)
     * @param $config array configuration updates or to use for this call
     * @return Result
     * @throws Exception
     */
    public function createXml($when, $url, $method, $document, $headers = [], $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        return $this->create([
            'when' => $when->format('Y-m-d H:i:s'),
            'type' => 'xml',
            'details' => [
                'url' => $url,
                'method' => $method,
                'document' => $document,
                'headers' => $headers
            ]
        ]);
    }

    /**
     * @param $when \DateTime when to fire the event
     * @param $url string the SQS QueueUrl from AWS
     * @param $document string document to add to the MessageBody { document: {...} }
     * @param $config array configuration updates or to use for this call
     * @return Result
     * @throws Exception
     */
    public function createSqs($when, $url, $document, $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        return $this->create([
            'when' => $when->format('Y-m-d H:i:s'),
            'type' => 'sqs',
            'details' => [
                'url' => $url,
                'document' => $document
            ]
        ]);
    }

    /**
     * @param $id string the ID of the event
     * @param $config array configuration updates or to use for this call
     */
    public function delete($id, $config = [])
    {
        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        $ch = curl_init('https://dev-api.anticipated.io/v1/event/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'x-api-key: ' . $this->_key
            ]
        );
        curl_exec($ch);
        curl_close($ch);
        return curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
    }


    public function get($id, $config = [])
    {

        if (count($config) > 0) {
            $this->applyConfig($config);
        }
        $ch = curl_init('https://dev-api.anticipated.io/v1/event/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPGET, true);

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Content-Type: application/json',
                'x-api-key: ' . $this->_key
            ]
        );

        $result = json_decode(curl_exec($ch));
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $responses = array_map(function ($response) {
            return new Response(
                $response->statusCode,
                $response->headers,
                $response->body,
                new \DateTime($response->date),
            );
        }, property_exists($result, 'responses') ? $result->responses : []);

        if ($statusCode >= 200 && $statusCode < 300) {
            return new Result(
                $statusCode === 200,
                $statusCode,
                new \DateTime($result->now),
                $result->context->user,
                $result->context->company,
                new Event($result->event->id, $result->event->company, new \DateTime($result->event->when), $result->event->type, new EventDetails($result->event->details)),
                $responses
            );
        }
        return new Result(
            false,
            $statusCode
        );
    }
}
