<?php

namespace PgSqlTypes\Doctrine\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class ArrayLength extends FunctionNode
{
    public $expr = null;
    public $dimension = null;

    /**
     * @override
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf(
            'ARRAY_LENGTH(%s, %s)',
            $this->expr->dispatch($sqlWalker),
            $sqlWalker->walkLiteral($this->dimension)
        );
    }

    /**
     * @override
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->expr = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->dimension = $parser->Literal();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
