<?php

namespace Pronto;

class Token
{
	private $type;
	private $value;

	const REGEX_T_EOL = '[\n\r]';
	const REGEX_T_OPENING_TAG = '\{';
	const REGEX_T_CLOSING_TAG = '\}';
	const REGEX_T_IDENT = '[a-zA-Z\_]';
	const REGEX_T_SYMBOL = '[\(\)\,]';
	const REGEX_T_NUMBER = '[0-9]';

	const REGEX_T_IDENT_CLOSING_START = '[\/]'; // /
	const REGEX_T_STRING_DELIMITER = '[\"\']'; // " '

	const REGEX_T_VAR = '[a-zA-Z\_]';
	const REGEX_T_VAR_START = '\?';
	const REGEX_T_GLOBAL_VAR = '\=';
	const REGEX_T_LOCAL_VAR = '\-';
	const REGEX_T_OP = '[\%\+\-\.\/\*\?]';

	const T_TEXT = 'T_TEXT';
	const T_OPENING_TAG = 'T_OPENING_TAG';
	const T_CLOSING_TAG = 'T_CLOSING_TAG';
	const T_STRING = 'T_STRING';
	const T_IDENT = 'T_IDENT';
	const T_GLOBAL_VAR = 'T_GLOBAL_VAR';
	const T_LOCAL_VAR = 'T_LOCAL_VAR';
	const T_NUMBER = 'T_NUMBER';
	const T_SYMBOL = 'T_SYMBOL';
	const T_OP = 'T_OP';
	const T_UNKNOWN = 'T_UNKNOWN';

	private static $tokentypes = [
		self::T_TEXT => 'T_TEXT',
		self::T_OPENING_TAG => 'T_OPENING_TAG',
		self::T_CLOSING_TAG => 'T_CLOSING_TAG',
		self::T_STRING => 'T_STRING',
		self::T_IDENT => 'T_IDENT',
		self::T_GLOBAL_VAR => 'T_GLOBAL_VAR',
		self::T_LOCAL_VAR => 'T_LOCAL_VAR',
		self::T_NUMBER => 'T_NUMBER',
		self::T_SYMBOL => 'T_SYMBOL',
		self::T_OP => 'T_OP',
		self::T_UNKNOWN => 'T_UNKNOWN',
	];

	public function __construct( $type, $value )
	{
		$this->type = $type;
		$this->value = $value;
	}

	public function getName()
	{
		return self::getNameByType($this->type);
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function __toString(): string
	{
		return $this->getType() . '(' . $this->getValue() . ')' . "\n";
	}

	public static function getNameByType(string $type)
	{
		if (isset(self::$tokentypes[$type])) {
			return self::$tokentypes[$type];
		}

		return 'T_UNKNOWN';
	}
}