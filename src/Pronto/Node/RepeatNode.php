<?php

namespace Pronto\Node;

use Pronto\Compiler;
use Pronto\Exception\SyntaxError;
use Pronto\Parser;
use Pronto\Token;

class RepeatNode extends Node
{
	public static function parse( Parser $parser )
	{
		if( $parser->accept( Token::T_IDENT, 'repeat' ) )
		{
			$parser->insert( new static() );
			$parser->traverseUp();
			$parser->advance();

			if( $parser->skip( Token::T_SYMBOL, '(' ) )
			{
				if( !ExpressionNode::parse( $parser ) ) {
					throw new SyntaxError('Expected expression');
				}

				$parser->setAttribute();
			}

			$parser->skip( Token::T_SYMBOL, ')' );

			if( $parser->skip( Token::T_CLOSING_TAG ) )
			{
				$parser->restartParse();
			}

			if( $parser->skip( Token::T_IDENT, '/repeat' ) )
			{
				if( $parser->skip( Token::T_CLOSING_TAG ) )
				{
					$parser->traverseDown();
					$parser->restartParse();
				}
			}

			return TRUE;
		}

		return FALSE;
	}

	public function compile( Compiler $compiler )
	{
		$compiler->writeBody( '<?php $env->repeat(function() use ( &$env ) { ?>' );

		foreach( $this->getChildren() as $child )
		{
			$child->compile( $compiler );
		}

		$compiler->writeBody( '<?php }' );

		if( count( $this->getAttributes() ) )
		{
			$compiler->writeBody( ',' );
		}

		foreach ( $this->getAttributes() as $a )
		{
			$subcompiler = new Compiler();
			$compiler->writeBody( $subcompiler->compile( $a ) );
		}

		$compiler->writeBody( '); ?>' );
	}
}