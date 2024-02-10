<?php
/**
 * OmnimessageApi
 * PHP version 5
 *
 * @category Class
 * @package  Messente\Api
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Messente API
 *
 * [Messente](https://messente.com) is a global provider of messaging and user verification services.  * Send and receive SMS, Viber, WhatsApp and Telegram messages. * Manage contacts and groups. * Fetch detailed info about phone numbers. * Blacklist phone numbers to make sure you're not sending any unwanted messages.  Messente builds [tools](https://messente.com/documentation) to help organizations connect their services to people anywhere in the world.
 *
 * The version of the OpenAPI document: 1.4.0
 * Contact: messente@messente.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.0.3
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Messente\Api\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Messente\Api\ApiException;
use Messente\Api\Configuration;
use Messente\Api\HeaderSelector;
use Messente\Api\ObjectSerializer;

/**
 * OmnimessageApi Class Doc Comment
 *
 * @category Class
 * @package  Messente\Api
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class OmnimessageApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $host_index (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $host_index = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $host_index;
    }

    /**
     * Set the host index
     *
     * @param  int Host index (required)
     */
    public function setHostIndex($host_index)
    {
        $this->hostIndex = $host_index;
    }

    /**
     * Get the host index
     *
     * @return Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation cancelScheduledMessage
     *
     * Cancels a scheduled Omnimessage
     *
     * @param  string $omnimessageId UUID of the scheduled omnimessage to be cancelled (required)
     *
     * @throws \Messente\Api\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return object|\Messente\Api\Model\ErrorOmnichannel
     */
    public function cancelScheduledMessage($omnimessageId)
    {
        list($response) = $this->cancelScheduledMessageWithHttpInfo($omnimessageId);
        return $response;
    }

    /**
     * Operation cancelScheduledMessageWithHttpInfo
     *
     * Cancels a scheduled Omnimessage
     *
     * @param  string $omnimessageId UUID of the scheduled omnimessage to be cancelled (required)
     *
     * @throws \Messente\Api\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of object|\Messente\Api\Model\ErrorOmnichannel, HTTP status code, HTTP response headers (array of strings)
     */
    public function cancelScheduledMessageWithHttpInfo($omnimessageId)
    {
        $request = $this->cancelScheduledMessageRequest($omnimessageId);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 202:
                    if ('object' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'object', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\Messente\Api\Model\ErrorOmnichannel' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Messente\Api\Model\ErrorOmnichannel', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'object';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'object',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Messente\Api\Model\ErrorOmnichannel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation cancelScheduledMessageAsync
     *
     * Cancels a scheduled Omnimessage
     *
     * @param  string $omnimessageId UUID of the scheduled omnimessage to be cancelled (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelScheduledMessageAsync($omnimessageId)
    {
        return $this->cancelScheduledMessageAsyncWithHttpInfo($omnimessageId)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation cancelScheduledMessageAsyncWithHttpInfo
     *
     * Cancels a scheduled Omnimessage
     *
     * @param  string $omnimessageId UUID of the scheduled omnimessage to be cancelled (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function cancelScheduledMessageAsyncWithHttpInfo($omnimessageId)
    {
        $returnType = 'object';
        $request = $this->cancelScheduledMessageRequest($omnimessageId);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'cancelScheduledMessage'
     *
     * @param  string $omnimessageId UUID of the scheduled omnimessage to be cancelled (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function cancelScheduledMessageRequest($omnimessageId)
    {
        // verify the required parameter 'omnimessageId' is set
        if ($omnimessageId === null || (is_array($omnimessageId) && count($omnimessageId) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $omnimessageId when calling cancelScheduledMessage'
            );
        }

        $resourcePath = '/omnimessage/{omnimessageId}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // path params
        if ($omnimessageId !== null) {
            $resourcePath = str_replace(
                '{' . 'omnimessageId' . '}',
                ObjectSerializer::toPathValue($omnimessageId),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation sendOmnimessage
     *
     * Sends an Omnimessage
     *
     * @param  \Messente\Api\Model\Omnimessage $omnimessage Omnimessage to be sent (required)
     *
     * @throws \Messente\Api\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Messente\Api\Model\OmniMessageCreateSuccessResponse|\Messente\Api\Model\ErrorOmnichannel
     */
    public function sendOmnimessage($omnimessage)
    {
        list($response) = $this->sendOmnimessageWithHttpInfo($omnimessage);
        return $response;
    }

    /**
     * Operation sendOmnimessageWithHttpInfo
     *
     * Sends an Omnimessage
     *
     * @param  \Messente\Api\Model\Omnimessage $omnimessage Omnimessage to be sent (required)
     *
     * @throws \Messente\Api\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Messente\Api\Model\OmniMessageCreateSuccessResponse|\Messente\Api\Model\ErrorOmnichannel, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendOmnimessageWithHttpInfo($omnimessage)
    {
        $request = $this->sendOmnimessageRequest($omnimessage);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 201:
                    if ('\Messente\Api\Model\OmniMessageCreateSuccessResponse' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Messente\Api\Model\OmniMessageCreateSuccessResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Messente\Api\Model\ErrorOmnichannel' === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Messente\Api\Model\ErrorOmnichannel', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Messente\Api\Model\OmniMessageCreateSuccessResponse';
            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Messente\Api\Model\OmniMessageCreateSuccessResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Messente\Api\Model\ErrorOmnichannel',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendOmnimessageAsync
     *
     * Sends an Omnimessage
     *
     * @param  \Messente\Api\Model\Omnimessage $omnimessage Omnimessage to be sent (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendOmnimessageAsync($omnimessage)
    {
        return $this->sendOmnimessageAsyncWithHttpInfo($omnimessage)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendOmnimessageAsyncWithHttpInfo
     *
     * Sends an Omnimessage
     *
     * @param  \Messente\Api\Model\Omnimessage $omnimessage Omnimessage to be sent (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendOmnimessageAsyncWithHttpInfo($omnimessage)
    {
        $returnType = '\Messente\Api\Model\OmniMessageCreateSuccessResponse';
        $request = $this->sendOmnimessageRequest($omnimessage);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    $responseBody = $response->getBody();
                    if ($returnType === '\SplFileObject') {
                        $content = $responseBody; //stream goes to serializer
                    } else {
                        $content = $responseBody->getContents();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'sendOmnimessage'
     *
     * @param  \Messente\Api\Model\Omnimessage $omnimessage Omnimessage to be sent (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function sendOmnimessageRequest($omnimessage)
    {
        // verify the required parameter 'omnimessage' is set
        if ($omnimessage === null || (is_array($omnimessage) && count($omnimessage) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $omnimessage when calling sendOmnimessage'
            );
        }

        $resourcePath = '/omnimessage';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // body params
        $_tempBody = null;
        if (isset($omnimessage)) {
            $_tempBody = $omnimessage;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($_tempBody));
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
