<?php

namespace PgSqlTypes\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\Type;

abstract class AbstractType extends Type
{
    /**
     * Return name of the type,
     * otherwise Doctrine will use name of the class.
     * Useful for `doctrine-module orm:convert-mapping --from-database`
     * to have correct types in @ORM\Column entity declaration.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
