<?php

namespace lib\Contract;

interface ImporterInterface
{
	public function __construct(StorageInterface $storage);
	public function import(): RuntimeInterface;
}