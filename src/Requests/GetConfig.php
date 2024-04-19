<?php

namespace FlourishLabs\SaloonOpenVidu\Requests;

use FlourishLabs\SaloonOpenVidu\Config;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetConfig extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/config';
    }

    public function createDtoFromResponse(Response $response): Config
    {
        return new Config($response->json());
    }
}
