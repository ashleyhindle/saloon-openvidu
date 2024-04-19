<?php

namespace FlourishLabs\SaloonOpenVidu\Requests\Sessions;

use FlourishLabs\SaloonOpenVidu\Session;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class ListSessions extends Request
{
    protected Method $method = Method::GET;

    public function __construct()
    {
    }

    public function resolveEndpoint(): string
    {
        return '/sessions';
    }

    // TODO: Sessions class? or type hint array containing sessions?
    public function createDtoFromResponse(Response $response): array
    {
        foreach ($response->json()['content'] as $sessions) {
            $sessions[] = Session::fromJson($sessions);
        }
        return $sessions;
    }
}
