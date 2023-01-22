<?php
declare(strict_types=1);

namespace Kubomikita\Kros\Omega\Attributes;

use Attribute;


#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
	public function __construct(public int $num, public bool $required = false)
	{
	}
}
