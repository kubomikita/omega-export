<?php

namespace Kubomikita\Kros\Omega;


abstract class ExportList {
	/** @var array  */
	protected $data = [];
	/** @var ExportItem[] */
	protected $items = [];

	public function addItem(ExportItem $item)
	{
		$this->items[] = $item;
	}

	function getData() : array
	{
		$this->data = [];
		$this->data[] = $this->getHeader();
		foreach ($this->items as $item){
			$this->data[] = $item->getRow();
		}

		return $this->data;
	}

	abstract public function createItem();
	abstract protected function getHeader() : array;
}