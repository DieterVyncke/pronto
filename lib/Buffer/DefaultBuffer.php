<?php

namespace lib\Buffer;

use lib\Contract\BufferInterface;

class DefaultBuffer implements BufferInterface
{
	private $contents;

	public function write(string $string): void
	{
		$this->contents .= $string;
	}

	public function read(): string
	{
		return $this->contents;
	}

	public function clear(): void
	{
		$this->contents = '';
	}
}