<?php

namespace Framework\View;

use Framework\View\Exception\ViewException;

class Config
{
    private array $settings;

    /**
     * @throws ViewException
     */
    public function setViewDir(string $path): self
    {
        if (!file_exists($path)) {
            throw new ViewException(sprintf('Folder not found: %s', $path));
        }

        $this->settings['viewDir'] = $path;
        return $this;
    }


    public function setExtension(bool $enable) : self
    {
        $this->settings['extension'] = $enable;
        return $this;
    }

    public function views(): string
    {
        return $this->settings['viewDir'];
    }


    public function useExtension(): bool
    {
        return $this->settings['extension'];
    }


}