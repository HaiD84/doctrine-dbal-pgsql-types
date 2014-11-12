doctrine-dbal-pgsql-types
=========================

This component allows you to manage some native [PostgreSQL](http://www.postgresql.org)
data types with the Doctrine [DBAL](http://www.doctrine-project.org/projects/dbal.html) component.


Usage
-----

To use the new types you shoud register them using the [Custom Mapping Types](https://doctrine-dbal.readthedocs.org/en/latest/reference/types.html#custom-mapping-types) feature.

```php
use PgSqlTypes\Doctrine\DBAL\Types\IntegerArrayType;
use PgSqlTypes\Doctrine\DBAL\Types\TextArrayType;
// ...

\Doctrine\DBAL\Types\Type::addType(
    IntegerArrayType::INTEGERARRAY,
    'PgSqlTypes\Doctrine\DBAL\Types\IntegerArrayType'
);
\Doctrine\DBAL\Types\Type::addType(
    TextArrayType::TEXTARRAY,
    'PgSqlTypes\Doctrine\DBAL\Types\TextArrayType'
);
/* @var $connection \Doctrine\DBAL\Connection */
$connection->getDatabasePlatform()->registerDoctrineTypeMapping(
    '_int4', IntegerArrayType::INTEGERARRAY
);
$connection->getDatabasePlatform()->registerDoctrineTypeMapping(
    '_text', TextArrayType::TEXTARRAY
);
```

New functions for these types are registered via [custom DQL functions](http://doctrine-orm.readthedocs.org/en/latest/cookbook/dql-user-defined-functions.html).

```php
/* @var $config \Doctrine\ORM\Configuration */
$config->addCustomStringFunction(
    'CONTAINED', 'PgSqlTypes\Doctrine\ORM\Query\AST\Functions\Contained'
);
$config->addCustomStringFunction(
    'ARRAY_LENGTH', 'PgSqlTypes\Doctrine\ORM\Query\AST\Functions\ArrayLength'
);
```

#### Usage with Symfony Standard Edition

If you want to use this with a Symfony Standard Edition application, you can [register the
new types](http://symfony.com/doc/current/cookbook/doctrine/dbal.html#registering-custom-mapping-types)
and [new DQL functions](http://symfony.com/doc/current/cookbook/doctrine/custom_dql_functions.html) in the `config.yml` file.

```yml
doctrine:
    dbal:
        types:
            integer[]: PgSqlTypes\Doctrine\DBAL\Types\IntegerArrayType
            text[]: PgSqlTypes\Doctrine\DBAL\Types\TextArrayType
        mapping_types:
            _int4: integer[]
            _text: text[]
    orm:
        dql:
            string_functions:
                contained: PgSqlTypes\Doctrine\ORM\Query\AST\Functions\Contained
                array_length: PgSqlTypes\Doctrine\ORM\Query\AST\Functions\ArrayLength
```

#### Custom functions

Doctrine doesn't allow to define custom operators like `<@` and other PostgreSQL operators.
For that purpose CONTAINED function was made. It is used like `contained(a, b)` in DQL and will be translated to `(a <@ b)` in raw SQL.
Full DQL example is:

```php
/* @var $qb \Doctrine\ORM\QueryBuilder */
$qb->andWhere('CONTAINED(:param, entityField) = TRUE')
    ->setParameter(':param', array('some value'), TextArrayType::TEXTARRAY);
```

Note that you have to explicitly specify array type in setParameter() method,
also parameter value have to be of array type.


License
-------

This component is under the MIT license. See the complete license in the LICENSE file.


About
-----

This component is inspired by [ant-hill/doctrine-dbal-pgsql-types](https://github.com/ant-hill/doctrine-dbal-pgsql-types),
[sasedev/doctrine-dbal-pgsql-types](https://github.com/sasedev/doctrine-dbal-pgsql-types),
and [ajgarlag/AjglDoctrineDbalPgsqlTypes](https://github.com/ajgarlag/AjglDoctrineDbalPgsqlTypes).

There is also [intaro/hstore-bundle](https://github.com/intaro/hstore-bundle), which can be interesting for HStore users.