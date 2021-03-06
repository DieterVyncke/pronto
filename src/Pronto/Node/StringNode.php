<?php

namespace Pronto\Node;

use Pronto\Compiler;
use Pronto\Parser;
use Pronto\Token;

class StringNode extends Node
{
	private $text;

	public function __construct($text)
	{
		$this->text = $text;
	}

	public static function parse(Parser $parser)
	{
		if ($parser->accept(Token::T_STRING)) {
			$parser->insert(new static($parser->getCurrentToken()->getValue()));
			$parser->advance();

			return true;
		}

		return false;
	}

	public function compile(Compiler $compiler)
	{
		$compiler->writeBody('\''.$this->text.'\'');
	}
}