<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Routing\GraphQL\RouteDirective;

use Railt\Reflection\Base\Dependent\BaseArgument;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\Reflection\Contracts\Document;

/**
 * Class ActionArgument
 */
class ActionArgument extends BaseArgument
{
    /**
     * Route action argument name
     */
    public const ARGUMENT_NAME = 'action';

    /**
     * Route action argument type
     */
    public const ARGUMENT_TYPE = 'String';

    /**
     * Route action argument description
     */
    public const ARGUMENT_DESCRIPTION = '';

    /**
     * ActionArgument constructor.
     * @param Document $document
     * @param TypeDefinition $parent
     */
    public function __construct(Document $document, TypeDefinition $parent)
    {
        $this->parent = $parent;
        $this->document = $document;

        $this->name = static::ARGUMENT_NAME;
        $this->description = static::ARGUMENT_DESCRIPTION;
    }

    /**
     * @return bool
     */
    public function isNonNull(): bool
    {
        return true;
    }

    /**
     * @return TypeDefinition
     */
    public function getTypeDefinition(): TypeDefinition
    {
        return $this->document->getTypeDefinition(self::ARGUMENT_TYPE);
    }
}
