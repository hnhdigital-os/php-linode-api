<?php

namespace HnhDigital\LinodeApi\Foundation;

/*
 * This file is part of the PHP Linode API.
 *
 * (c) H&H|Digital <hello@hnh.digital>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use GuzzleHttp\Client as Guzzle;

/**
 * This is the API Request class.
 *
 * @author Rocco Howard <rocco@hnh.digital>
 */
trait ApiRequestTrait
{
    /**
     * Guzzle client.
     *
     * @var Guzzle
     */
    private $client;

    /**
     * Make an api call.
     *
     * @param string $method
     * @param string $uri
     * @param string $payload
     *
     * @return mixed
     */
    protected function apiCall($method, $uri, $payload = [], $headers = [])
    {
        if (is_null($this->client)) {
            $this->client = new Guzzle([
                'base_uri' => Auth::getBaseEndpoint(),
            ]);
        }

        // Authorization.
        Auth::getHeader($headers);

        // Add headers to the payload.
        $payload['headers'] = $headers;

        try {

            // Add the placeholders.
            $endpoint_url = sprintf($this->endpoint.$uri, ...$this->endpoint_placeholders);

            // Request to the given endpoint, and process the response.
            return $this->processResponse($method, $this->client->request(
                $method,
                $endpoint_url,
                $payload
            ));

        } catch (\Exception $exception) {
            // Throw an error if the request fails
            throw new LinodeApiException($exception->getMessage());
        }
    }

    /**
     * Process the response.
     *
     * @param string $method
     * @param string $response
     *
     * @return bool|array
     */
    private function processResponse($method, $response)
    {
        $contents = $response->getBody()->getContents();
        $decoded_contents = json_decode($contents, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded_contents;
        }

        throw new LinodeApiException('Could not decode response. '.$contents);
    }
}