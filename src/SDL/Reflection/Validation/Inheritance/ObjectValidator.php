<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Validation\Inheritance;

use Railt\SDL\Contracts\Behavior\AllowsTypeIndication;
use Railt\SDL\Contracts\Definitions\ObjectDefinition;
use Railt\SDL\Contracts\Definitions\TypeDefinition;
use Railt\SDL\Exceptions\TypeConflictException;

/**
 * Class ObjectValidator
 */
class ObjectValidator extends BaseInheritanceValidator
{
    /**
     * @param AllowsTypeIndication|TypeDefinition $child
     * @param AllowsTypeIndication|TypeDefinition $parent
     * @return bool
     */
    public function match(TypeDefinition $child, TypeDefinition $parent): bool
    {
        return $parent instanceof AllowsTypeIndication &&
            $parent->getTypeDefinition() instanceof ObjectDefinition;
    }

    /**
     * @param AllowsTypeIndication|TypeDefinition $child
     * @param AllowsTypeIndication|TypeDefinition $parent
     * @return void
     * @throws TypeConflictException
     */
    public function validate(TypeDefinition $child, TypeDefinition $parent): void
    {
        \assert($parent->getTypeDefinition() instanceof ObjectDefinition);

        if (! $this->isEqualType($child, $parent)) {
            $this->throwIncompatibleTypes($child, $parent);
        }
    }
}