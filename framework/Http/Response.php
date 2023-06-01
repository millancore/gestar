<?php

namespace Framework\Http;

class Response
{
    public function __construct(
        public readonly string $content,
        public readonly int $status,
        public readonly array $headers
    )
    {
    }

    public function send(): void
    {
        http_response_code($this->status);

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $this->content;
    }

}