<?php
namespace PgSqlTypes\Doctrine\DBAL\Types;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class SmallIntArrayType extends AbstractArrayType
{
    const SMALLINTARRAY = 'smallint[]';

    protected $name = self::SMALLINTARRAY;

    protected $innerTypeName = 'smallint';
}
