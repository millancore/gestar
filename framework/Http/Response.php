<?php

namespace Framework\Http;

readonly class Response
{
    public function __construct(
        public string $content,
        public int    $status,
        public array  $headers = []
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

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

}