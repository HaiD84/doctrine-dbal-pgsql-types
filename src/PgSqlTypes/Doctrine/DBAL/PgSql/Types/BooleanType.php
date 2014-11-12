<?php

namespace PgSqlTypes\Doctrine\DBAL\PgSql\Types;

use Doctrine\DBAL\Types\BooleanType as OriginalBooleanType;

class BooleanType extends OriginalBooleanType
{
    /**
     * Basically Doctrine converts boolean to strings 'true' and 'false',
     * but this strategy fails when PDO attribute ATTR_EMULATE_PREPARES is used.
     *
     * Trick PDO with passing boolean as a string.
     *
     * {@inheritdoc}
     */
    public function getBindingType()
    {
        return \PDO::PARAM_STR;
    }
}