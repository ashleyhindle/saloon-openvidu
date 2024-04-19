<?php

namespace FlourishLabs\SaloonOpenVidu;

use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;

class OpenVidu extends Connector
{
    /**
     * @param  string  $secret  - https://docs.openvidu.io/en/stable/reference-docs/openvidu-config/
     * @param  string  $url  - https://openvidu.example.com
     */
    public function __construct(private string $secret, private string $url)
    {

    }

    public function resolveBaseUrl(): string
    {
        return $this->url.'/openvidu/api/';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultAuth(): BasicAuthenticator
    {
        return new BasicAuthenticator('OPENVIDUAPP', $this->secret);
    }
}
