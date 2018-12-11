<?php

namespace lib\Output;

use lib\Contract\OutputInterface;

class FileOutput implements OutputInterface
{
	private $filename;

	public function __construct(string $filename)
	{
		$this->filename = $filename;
	}

	public function write(String $string)
	{
		file_put_contents($this->filename, $string);
	}
}