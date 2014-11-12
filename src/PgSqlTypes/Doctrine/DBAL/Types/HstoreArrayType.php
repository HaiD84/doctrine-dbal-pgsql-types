<?php
namespace PgSqlTypes\Doctrine\DBAL\Types;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class HstoreArrayType extends AbstractArrayType
{
    const HSTOREARRAY = 'hstore[]';

    protected $name = self::HSTOREARRAY;

    protected $innerTypeName = 'hstore';
}
