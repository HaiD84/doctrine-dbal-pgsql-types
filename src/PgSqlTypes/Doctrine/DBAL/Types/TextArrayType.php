<?php
namespace PgSqlTypes\Doctrine\DBAL\Types;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class TextArrayType extends AbstractArrayType
{
    const TEXTARRAY = 'text[]';

    protected $name = self::TEXTARRAY;

    protected $innerTypeName = 'text';
}
