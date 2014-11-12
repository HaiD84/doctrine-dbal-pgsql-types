<?php
namespace PgSqlTypes\Doctrine\DBAL\Types;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class IntegerArrayType extends AbstractArrayType
{
    const INTEGERARRAY = 'integer[]';

    protected $name = self::INTEGERARRAY;

    protected $innerTypeName = 'integer';
}
