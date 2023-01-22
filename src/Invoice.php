<?php

namespace Kubomikita\Kros\Omega;

use DateTimeInterface;
use JetBrains\PhpStorm\Deprecated;
use Kubomikita\Kros\Omega\Attributes\Column;
use Nette\InvalidArgumentException;

/**
 * @group T01
 */
final class Invoice extends ExportItem {

	const TYPES = [
		0 => 'odberateľská faktúra',
		1 => 'preddavková faktúra',
		2  => 'dodací list',
        3  => 'odoslaná objednávka',
		4  => 'odoslaný dobropis',
		5  => 'zákazkový list',
		6  => 'likvidačný list',
		7  => 'reklamácia',
		8  => 'upomienka',
		9  => 'penalizačná faktúra',
		10  => 'storno faktúra',
		11  => 'došlá objednávka',
		12  => 'cenová ponuka',
		13  => 'predajka',
		14  => 'došlá faktúra',
	];

	const TYPE_INVOICE = 0;
	const TYPE_EXPENSE = 14;

	const CODES = [
		self::TYPE_INVOICE => 'OF',
		self::TYPE_EXPENSE => 'DF'
	];

	#[Column(1, required: true)]
	protected $ident = 'R01'; // 1
	#[Column(2, required: true)]
	protected $number;
	#[Column(3, required: true)]
	protected $partnerName;
	#[Column(4, required: true)]
	protected $partnerRegNo;
	#[Column(5, required: true)]
	protected $dateCreate;
	#[Column(6, required: true)]
	protected $dateDue;
	#[Column(7, required: true)]
	protected $dateTax;
	#[Column(18)]
	protected $type;
	#[Column(19)]
	protected $code;
	#[Column(20)]
	protected $codePrefix;
	#[Column(12, required: true)]
	protected $vat10 = 10;
	#[Column(13, required: true)]
	protected $vat20 = 20;
	protected $vat = 20;
	#[Column(14, required: true)]
	protected $amountVat10 = 0;
	#[Column(15, required: true)]
	protected $amountVat20 = 0;

	#[Column(8, required: true)]
	protected $base10 = 0;
	#[Column(9, required: true)]
	protected $base20 = 0;
	#[Column(10, required: true)]
	protected $baseNull = 0;
	#[Column(11, required: true)]
	protected $baseNoVat = 0;

	#[Column(17, required: true)]
	protected $amount;
	#[Column(16, required: true)]
	protected $priceCorrection = 0;
	#[Column(32)]
	protected $ending;
	#[Column(40)]
	protected $currency = "EUR";
	#[Column(41)]
	protected $currencyQuantity = 1;
	#[Column(42)]
	protected $exchangeRate = 1.0;
	#[Column(43)]
	protected $amountCurrency;
	#[Column(44)]
	protected $documentNumber;
	#[Column(71)]
	protected $vs;
	#[Column(46)]
	protected $subject;

	#[Column(35)]
	protected $issuedBy;
	#[Column(36)]
	protected $constant;
	#[Column(37)]
	protected $specific;
	#[Column(57)]
	protected $iban;
	#[Column(56)]
	protected $swift;
	#[Column(51)]
	protected $bankName;
	#[Column(45)]
	protected $note;
	#[Column(31)]
	protected $noteBefore;
	#[Column(38)]
	protected $paymentType;

	private $vatPay = false;

	public function setPaymentType($paymentType): Invoice
	{
		$this->paymentType = $paymentType;
		return $this;
	}
	public function setNoteBefore($noteBefore): Invoice
	{
		$this->noteBefore = $noteBefore;
		return $this;
	}

	public function setIssuedBy($issuedBy): Invoice
	{
		$this->issuedBy = $issuedBy;
		return $this;
	}

	public function setConstant($constant): Invoice
	{
		$this->constant = $constant;
		return $this;
	}

	public function setSpecific($specific): Invoice
	{
		$this->specific = $specific;
		return $this;
	}

	public function setIban($iban): Invoice
	{
		$this->iban = $iban;
		return $this;
	}

	public function setSwift($swift): Invoice
	{
		$this->swift = $swift;
		return $this;
	}

	public function setBankName($bankName): Invoice
	{
		$this->bankName = $bankName;
		return $this;
	}

	public function setNote($note): Invoice
	{
		$this->note = $note;
		return $this;
	}

	public function setNumber( int|string $number ): Invoice {
		$this->number = $number;
		$this->ending = $number;
		return $this;
	}


	public function setPartnerName( string $partnerName ): Invoice {
		$this->partnerName = $partnerName;

		return $this;
}


	public function setPartnerRegNo( int $partnerRegNo ): Invoice {
		$this->partnerRegNo = $partnerRegNo;

		return $this;
}

	public function setDateCreate( DateTimeInterface $dateCreate ): Invoice {
		$this->dateCreate = $dateCreate;

		return $this;
}

	public function setDateDue( DateTimeInterface $dateDue ): Invoice {
		$this->dateDue = $dateDue;

		return $this;
}


	public function setDateTax( DateTimeInterface $dateTax ): Invoice {
		$this->dateTax = $dateTax;

		return $this;
}


	public function setType( int $type ): Invoice {
		if(!isset(self::TYPES[$type])){
			throw new InvalidArgumentException('Invoice type with key \''.$type.'\' not exists.');
		}

		$this->type = $type;

		return $this;
}


	public function getCode(): string {
		if($this->code === null){
			$this->code = self::CODES[$this->type];
		}
		return $this->code;
	}


	public function getCodePrefix(): string {
		if($this->codePrefix === null){
			$this->codePrefix = self::CODES[$this->type];
		}
		return $this->codePrefix;
	}


	public function setCode( string $code ): Invoice {
		$this->code = $code;

		return $this;
	}


	public function setCodePrefix( string $codePrefix ): Invoice {
		$this->codePrefix = $codePrefix;

		return $this;
	}

	public function setBase(float $base, ?int $vat = null): Invoice {

		$vat = min($vat, 20);

		$property = match ($vat){
			null => "baseNoVat",
			0 => "baseNull",
			10 => "base10",
			20 => "base20",
		};

		$this->{$property} = $base;
		return $this;
	}

	public function setVatAmount(float $amount, int $vat): Invoice {
		$vat = min($vat, 20);

		$property = match ($vat){
			10 => "amountVat10",
			20 => "amountVat20",
		};
		$this->{$property} = $amount;
		return $this;
	}


	public function setAmount( float $amount ): Invoice {

		$this->amount = round($amount,4);

		return $this;
	}

	#[Deprecated]
	public function setVat( int $vat ): Invoice {
		$this->vat = $vat;

		return $this;
	}


	public function setSubject( string $subject ): Invoice {
		$this->subject = $subject;

		return $this;
}


	public function setVs( int $vs ): Invoice {
		$this->vs = $vs;

		return $this;
}

	public function setDocumentNumber( int $documentNumber ): Invoice {
		$this->documentNumber = $documentNumber;

		return $this;
}

	public function setVatPay(bool $vatPay): self
	{
		$this->vatPay = $vatPay;
		return $this;
	}
}