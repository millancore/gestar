<?php

namespace Xfrmk\View;

use Closure;
use Xfrmk\View\Exception\ComponentException;
use Xfrmk\View\Exception\ViewException;
use SplStack;
use Throwable;

class Resolver
{
    private SplStack $stack;

    protected static $instance;

    protected Config $config;

    protected array $filters = [];

    /**
     * @throws ViewException
     */
    public function __construct(array $config = [])
    {
        if (!is_null(static::$instance)) {
            throw new ViewException('A View instance has been declare');
        }

        static::$instance = $this;
        $this->stack = new SplStack();
    }


    public static function getInstance(): Resolver
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set Config values
     * @param Config|null $config
     * @return void
     */
    public function config(?Config $config): void
    {
        $this->config = $config;
    }

    /**
     * Start render ViewComponent
     *
     * @param string $path
     * @param array $params
     * @throws ViewException
     */
    public function start(string $path, array $params = []): void
    {
        $path = $this->checkConfig($path);

        if (!file_exists($path)) {
            throw new ViewException(sprintf('Template not found: %s', $path));
        }

        /** An output buffer is initialised. */
        ob_start();

        $this->stack->push(new Component($path, $params));
    }


    /**
     * Validate if exits config parameters
     *
     * @param string $path
     * @return string
     */
    private function checkConfig(string $path): string
    {
        $path = $this->config->views() . DIRECTORY_SEPARATOR . $path;
        return !$this->config->useExtension() ? $path . '.php' : $path;
    }

    /**
     *  Return var in Json format
     * @param $var
     * @return false|string
     */
    public function json($var): false|string
    {
        return json_encode($var);
    }


    /**
     * End render ViewComponent
     * @throws ComponentException
     */
    public function end(): void
    {
        /** @var $viewComponent Component */
        $viewComponent = $this->getLastComponent();

        $viewComponent->setContent(ob_get_clean());

        /** Create variables from array */
        $vars = $viewComponent->params;

        extract($vars);

        include $viewComponent->path;
    }


    /**
     * Slot insert content between Start and End
     * @return string
     * @throws ComponentException
     */
    public function slot(): string
    {
        /** @var $viewComponent Component */
        $viewComponent = $this->getLastComponent(true);

        return $viewComponent->getContent();
    }


    /**
     * Render full Component
     * @param string $path
     * @param array $data
     * @return false|string
     * @throws Throwable
     */
    public function render(string $path, array $data = []): false|string
    {
        extract($data);
        $level = ob_get_level();

        $path = $this->checkConfig($path);

        try {
            ob_start();

            include $path;
            return ob_get_clean();

        } catch (Throwable $e) {
            $this->cleanStack($level);
            throw new ViewException($e->getMessage(), $e->getCode(), $e);
        }
    }


    /**
     * Add filter
     *
     * @param string $name
     * @param Closure $filter
     * @return void
     */
    public function addFilter(string $name, Closure $filter): void
    {
        $this->filters[$name] = $filter;
    }


    /**
     * Use registered filter
     *
     * @param $value
     * @param string $filterName
     * @return mixed
     * @throws ViewException
     */
    public function filter($value, string $filterName): mixed
    {
        if (!isset($this->filters[$filterName])) {
            throw new ViewException(sprintf(
                'The filter "%s" does not exists', $filterName
            ));
        }

        return call_user_func($this->filters[$filterName], $value);
    }


    /**
     * Get last element from Stack
     * @param bool $remove
     * @return mixed
     * @throws ComponentException
     */
    public function getLastComponent(bool $remove = false): mixed
    {
        if ($this->stack->isEmpty()) {
            throw new ComponentException(
                'Component no found, Make sure to Initialize the component with View::Start'
            );
        }

        if ($remove) {
            return $this->stack->pop();
        }

        return $this->stack->top();
    }

    /**
     * Clear Stack Components
     */
    public function cleanStack(int $obLevel = 0): void
    {
        if ($obLevel > 0) {
            $obLevel = ob_get_level();
        }

        $this->stack = new SplStack();

        while (ob_get_level() > $obLevel) {
            ob_end_clean();
        }
    }
}
