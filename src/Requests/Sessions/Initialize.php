<?php

namespace FlourishLabs\SaloonOpenVidu\Requests\Sessions;

use FlourishLabs\SaloonOpenVidu\Exceptions\SessionIdInUse;
use FlourishLabs\SaloonOpenVidu\Session;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use Throwable;

class Initialize extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(protected Session $session)
    {
    }

    protected function defaultBody(): array
    {
        return array_filter([
            'mediaMode' => $this->session->mediaMode,
            'recordingMode' => $this->session->recordingMode,
            'customSessionId' => $this->session->customSessionId,
            'forcedVideoCodec' => $this->session->forcedVideoCodec,
            'allowTranscoding' => $this->session->allowTranscoding,
            'defaultRecordingProperties' => $this->session->defaultRecordingProperties,
            'mediaNode' => $this->session->mediaNode,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/sessions';
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        if ($response->status() === 409) {
            throw new SessionIdInUse(sprintf('Session ID %s is already in use. You can continue to use it, or generate a new unique one', $this->session->customSessionId));
        }

        throw $senderException;
    }

    public function createDtoFromResponse(Response $response): Session
    {
        if ($response->status() === 409) {
            $response->throw();
        }

        return Session::fromJson($response->json());
    }
}
