<?php

namespace Kubomikita\Kros\Omega;


use Kubomikita\Kros\Omega\Attributes\Column;
use Nette\Utils\Strings;
use Nette\InvalidArgumentException;
use ReflectionClass;

abstract class ExportItem {

	public function getRow() : array
	{
		$reflection = new ReflectionClass($this);
		$row = [];
		foreach ($reflection->getProperties() as $property) {
			if($property->isProtected()) {
				$attributes = $property->getAttributes();
				if(!empty($attributes)){
					$attribute = $attributes[0]->newInstance();
					if($attribute instanceof Column) {
						$getterName = 'get'.Strings::firstUpper($property->getName());
						$value = $property->getDeclaringClass()->hasMethod($getterName) ? $this->{$getterName}() : $this->{$property->getName()};
						if($attribute->required && $value === null){
							throw new InvalidArgumentException("Property '".$property->getName()."' of '".get_called_class()."' is required. Column number ".$attribute->num.".");
						}

						if(is_bool($value)){
							$value = ($value ? "T" : "F");
						}
						if($value instanceof \DateTimeInterface){
							$value = $value->format('d.m.Y');
						}

						$row[($attribute->num - 1)] = (string) $value;
					}

				}
			}
		}
		$max = max(array_keys($row));

		for($i=1;$i<=$max;$i++){
			if(!isset($row[$i])){
				$row[$i] = '';
			}
		}

		ksort($row);

		return $row;
	}
}