<?php

namespace Framework\View;

class Component
{
    private string $content;

    public function __construct(
        readonly string $path,
        readonly array $params = [],
        string $content = '')
    {
        //
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return spl_object_id($this);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}