<?php

namespace Kubomikita\Kros\Omega;

use Kubomikita\Kros\Omega\Attributes\Column;

/**
 * @group T01
 */
final class InvoiceItem extends ExportItem {

	const TYPES = [

	];

	const TYPE_SERVICE = "S";
	const TYPE_ITEM = "K";
	const TYPE_FREE = "V";

	#[Column(1, required: true)]
	protected $ident = 'R02'; // 1
	#[Column(2, required: true)]
	protected $name;
	#[Column(3, required: true)]
	protected $quantity = 1;
	#[Column(4, required: true)]
	protected $unit = '';
	#[Column(5, required: true)]
	protected $priceNoVat;
	#[Column(6, required: true)]
	protected $vatRate = "X";
	#[Column(10)]
	protected $type;
	#[Column(14)]
	protected $synteticAccount;
	#[Column(15)]
	protected $analyticAccount;

	public function setName( string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function setQuantity(int $quantity): self
	{
		$this->quantity = $quantity;
		return $this;
	}


	public function setUnit($unit): self
	{
		$this->unit = $unit;
		return $this;
	}


	public function setPriceNoVat($priceNoVat): self
	{
		$this->priceNoVat = $priceNoVat;
		return $this;
	}


	public function setVatRate(?int $vatRate = null): self
	{
		$vatRate = min($vatRate, 20);
		$this->vatRate = match ($vatRate){
			0 => "0",
			10 => "N",
			20 => "V",
			null => "X",
 		};
		return $this;
	}

	public function setType($type): self
	{
		$this->type = $type;
		return $this;
	}

	public function setAnalyticAccount($analyticAccount): self
	{
		$this->analyticAccount = $analyticAccount;
		return $this;
	}


	public function setSynteticAccount($synteticAccount): self
	{
		$this->synteticAccount = $synteticAccount;
		return $this;
	}
}