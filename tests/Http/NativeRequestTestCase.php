<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Tests\Http;

use PHPUnit\Framework\Assert;
use Serafim\Railgun\Http\NativeRequest;
use Serafim\Railgun\Http\RequestInterface;
use Serafim\Railgun\Tests\AbstractTestCase;

/**
 * Class NativeRequestTestCase
 * @package Serafim\Railgun\Tests\Http
 */
class NativeRequestTestCase extends AbstractHttpRequestTestCase
{

    /**
     * @param string $body
     * @param bool $makeJson
     * @return RequestInterface
     */
    protected function request(string $body, bool $makeJson = true): RequestInterface
    {
        if ($makeJson) {
            $_SERVER['CONTENT_TYPE'] = 'application/json';
        }

        return new class($body) extends NativeRequest {
            /**
             * @var string
             */
            private $body;

            /**
             * Anonymous class constructor.
             * @param string $body
             */
            public function __construct(string $body)
            {
                $this->body = $body;
                parent::__construct();
            }

            /**
             * @return string
             */
            final protected function getInputStream(): string
            {
                Assert::assertEquals('', parent::getInputStream());

                return $this->body;
            }
        };
    }
}
