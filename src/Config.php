<?php

namespace FlourishLabs\SaloonOpenVidu;

#[AllowDynamicProperties]
class Config
{
    public string $version;

    public string $domain_or_public_ip;

    public int $https_port;

    public string $openvidu_publicurl;

    public bool $openvidu_cdr;

    public int $openvidu_streams_video_max_recv_bandwidth;

    public int $openvidu_streams_video_min_recv_bandwidth;

    public int $openvidu_streams_video_max_send_bandwidth;

    public int $openvidu_streams_video_min_send_bandwidth;

    public string $openvidu_streams_forced_video_codec;

    public bool $openvidu_streams_allow_transcoding;

    public bool $openvidu_webrtc_simulcast;

    public int $openvidu_sessions_garbage_interval;

    public int $openvidu_sessions_garbage_threshold;

    public bool $openvidu_recording;

    public string $openvidu_recording_version;

    public string $openvidu_recording_path;

    public bool $openvidu_recording_public_access;

    public string $openvidu_recording_notification;

    public string $openvidu_recording_custom_layout;

    public int $openvidu_recording_autostop_timeout;

    public bool $openvidu_webhook;

    public array $unknown;

    public function __construct(public array $rawConfig)
    {
        foreach ($rawConfig as $key => $value) {
            $key = strtolower($key);
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            } else {
                $this->unknown[$key] = $value;
            }
        }
    }
}
