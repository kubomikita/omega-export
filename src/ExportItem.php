<?php

namespace Kubomikita\Kros\Omega;


use Nette\Utils\Strings;
use Nette\InvalidArgumentException;
use Nette\Reflection\AnnotationsParser;
use ReflectionClass;

abstract class ExportItem {

	public function getRow() : array {
		$reflection = new ReflectionClass($this);
		$row = [];

		foreach ($reflection->getProperties() as $property) {
			if($property->isProtected()) {
				$annotations = AnnotationsParser::getAll( $property );
				if(isset($annotations["column"]) && ($column = $annotations["column"][0]) !== null) {
					$getterName = 'get'.Strings::firstUpper($property->getName());
					$value = $property->getDeclaringClass()->hasMethod($getterName) ? $this->{$getterName}() : $this->{$property->getName()};
					if(isset($annotations["required"]) && $value === null){
						throw new InvalidArgumentException("Property '".$property->getName()."' of '".get_called_class()."' is required.");
					}

					if(is_bool($value)){
						$value = ($value ? "T" : "F");
					}
					if($value instanceof \DateTimeInterface){
						$value = $value->format('d.m.Y');
					}

					$row[($annotations["column"][0] - 1)] = (string) $value;
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