<?php

namespace FlourishLabs\SaloonOpenVidu;

/**
 * Refs: https://docs.openvidu.io/en/stable/reference-docs/REST-API/#the-session-object
 */
class Session
{
    public ?string $id = null;

    public string $object = 'session';

    public string $mediaMode = 'ROUTED';

    public string $recordingMode = 'MANUAL';

    public string $customSessionId;

    public string $forcedVideoCodec = 'VP8';

    public bool $allowTranscoding = false;

    public bool $recording = false;

    public bool $broadcasting = false;

    public array $connections = [];

    public array $defaultRecordingProperties = [
        'name' => 'MyRecording',
        'hasAudio' => true,
        'hasVideo' => true,
        'outputMode' => 'COMPOSED',
        'recordingLayout' => 'BEST_FIT',
        'resolution' => '1280x720',
        'frameRate' => 30,
        'shmSize' => 536870912,
    ];

    public array $mediaNode = [];

    public \DateTimeInterface $createdAt;

    public function __construct(string $customSessionId)
    {
        $this->customSessionId = $customSessionId;
        $this->defaultRecordingProperties['name'] = 'recording-'.$this->customSessionId;
    }

    public static function fromJson(array $data): Session
    {
        if (empty($data)) {
            throw new \InvalidArgumentException('Session data is empty');
        }

        $session = new self($data['id'] ?? $data['sessionId'] ?? $data['customSessionId'] ?? 'generate-random-sessionid');
        $session->id = $data['id'];
        $session->customSessionId = $data['customSessionId'];
        $session->object = $data['object'];
        $session->createdAt = new \DateTime('@' . (string) $data['createdAt']/1000);
        $session->mediaMode = $data['mediaMode'];
        $session->recordingMode = $data['recordingMode'];
        $session->forcedVideoCodec = $data['forcedVideoCodec'];
        $session->allowTranscoding = $data['allowTranscoding'];
        $session->recording = $data['recording'];
        $session->broadcasting = $data['broadcasting'];
        $session->connections = $data['connections'];
        $session->defaultRecordingProperties = $data['defaultRecordingProperties'];
        $session->mediaNode = $data['mediaNode'] ?? [];

        return $session;
    }
}
