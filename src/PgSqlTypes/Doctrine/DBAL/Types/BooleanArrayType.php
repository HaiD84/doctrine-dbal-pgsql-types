<?php
namespace PgSqlTypes\Doctrine\DBAL\Types;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class BooleanArrayType extends AbstractArrayType
{

    const BOOLEANARRAY = 'boolean[]';

    protected $name = self::BOOLEANARRAY;

    protected $innerTypeName = 'boolean';
}
