<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Http\Pipeline\Handler;

use Railt\Http\RequestInterface;
use Railt\Http\ResponseInterface;
use Railt\Http\Pipeline\MiddlewareInterface;

/**
 * Class Next
 */
class Next implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    private HandlerInterface $handler;

    /**
     * @var MiddlewareInterface
     */
    private MiddlewareInterface $middleware;

    /**
     * Next constructor.
     *
     * @param MiddlewareInterface $middleware
     * @param HandlerInterface $handler
     */
    public function __construct(MiddlewareInterface $middleware, HandlerInterface $handler)
    {
        $this->middleware = $middleware;
        $this->handler = $handler;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        return $this->middleware->handle($request, $this->handler);
    }
}