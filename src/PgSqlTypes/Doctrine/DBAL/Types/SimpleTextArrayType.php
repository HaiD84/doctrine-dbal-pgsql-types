<?php

namespace PgSqlTypes\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Same as TextArrayType, but with much faster parsing PgSql array to PHP array.
 * Works only with single-dimensional arrays and values without tricky quote escaping.
 * (Doctrine fails to save quotes and braces in PgSql array anyway).
 */
class SimpleTextArrayType extends TextArrayType
{
    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return $value;
        }
        if ('{}' == $value) {
            return array();
        }

        return str_getcsv(trim($value, '{}'), ',', '"');
    }
}
