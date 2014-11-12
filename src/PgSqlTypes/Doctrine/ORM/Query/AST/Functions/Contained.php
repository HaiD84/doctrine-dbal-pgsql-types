<?php

namespace PgSqlTypes\Doctrine\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

class Contained extends FunctionNode
{
    public $left = null;
    public $right = null;

    /**
     * @override
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf(
            '(%s <@ %s)',
            $this->left->dispatch($sqlWalker),
            $this->right->dispatch($sqlWalker)
        );
    }

    /**
     * @override
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->left = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->right = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
