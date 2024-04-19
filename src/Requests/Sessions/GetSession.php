<?php

namespace FlourishLabs\SaloonOpenVidu\Requests\Sessions;

use FlourishLabs\SaloonOpenVidu\Session;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetSession extends Request
{
    protected Method $method = Method::GET;
    public function __construct(protected string $sessionId)
    {
    }

    public function resolveEndpoint(): string
    {
        return '/sessions/' . $this->sessionId;
    }

    public function createDtoFromResponse(Response $response): Session
    {
        return Session::fromJson($response->json());
    }
}
