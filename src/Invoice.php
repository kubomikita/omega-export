<?php

namespace Kubomikita\Kros\Omega;

use DateTimeInterface;
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

	/**
	 * @required
	 * @column 1
	 * @var string
	 */
	protected $ident = 'R01'; // 1
	/**
	 * @required
	 * @column 2
	 * @var int
	 */
	protected $number;
	/**
	 * @required
	 * @column 3
	 * @var string
	 */
	protected $partnerName;

	/**
	 * @required
	 * @column 4
	 * @var int
	 */
	protected $partnerRegNo;
	/**
	 * @required
	 * @column 5
	 * @var DateTimeInterface
	 */
	protected $dateCreate;
	/**
	 * @required
	 * @column 6
	 * @var DateTimeInterface
	 */
	protected $dateDue;
	/**
	 * @required
	 * @column 7
	 * @var DateTimeInterface
	 */
	protected $dateTax;

	/**
	 * @required
	 * @column 18
	 * @var int
	 */
	protected $type;

	/**
	 * @column 19
	 * @var string
	 */
	protected $code;

	/**
	 * @column 20
	 * @var string
	 */
	protected $codePrefix;

	/**
	 * @required
	 * @column 12
	 * @var int
	 */
	protected $vat10 = 10;
	/**
	 * @required
	 * @column 13
	 * @var int
	 */
	protected $vat20 = 20;
	/**
	 * @var int
	 */
	protected $vat = 20;
	/**
	 * @required
	 * @column 14
	 * @var int
	 */
	protected $amountVat10 = 0;
	/**
	 * @required
	 * @column 15
	 * @var int
	 */
	protected $amountVat20 = 0;
	/**
	 * @required
	 * @column 11
	 * @var float
	 */
	protected $base = 0;

	/**
	 * @required
	 * @column 10
	 * @var float
	 */
	protected $baseNull = 0;
	/**
	 * @required
	 * @column 8
	 * @var float
	 */
	protected $base10 = 0;
	/**
	 * @required
	 * @column 9
	 * @var float
	 */
	protected $base20;

	/**
	 * @required
	 * @column 17
	 * @var float
	 */
	protected $amount;

	/**
	 * @required
	 * @column 16
	 * @var int
	 */
	protected $priceCorrection = 0;
	/**
	 * @column 32
	 * @var int
	 */
	protected $ending;
	/**
	 * @column 40
	 * @var int
	 */
	protected $currency = "EUR";

	/**
	 * @column 41
	 * @var int
	 */
	protected $currencyQuantity = 1;


	/**
	 * @column 42
	 * @var float
	 */
	protected $exchangeRate = 1.0;
	/**
	 * @column 43
	 * @var float
	 */
	protected $amountCurrency;

	/**
	 * @column 44
	 * @var int
	 */
	protected $documentNumber;
	/**
	 * @column 71
	 * @var int
	 */
	protected $vs;
	/**
	 * @column 46
	 * @var string
	 */
	protected $subject;

	/**
	 * @param int $number
	 *
	 * @return Invoice
	 */
	public function setNumber( int $number ): Invoice {
		$this->number = $number;
		$this->ending = $number;
		return $this;
	}

	/**
	 * @param string $partnerName
	 *
	 * @return Invoice
	 */
	public function setPartnerName( string $partnerName ): Invoice {
		$this->partnerName = $partnerName;

		return $this;
}

	/**
	 * @param int $partnerRegNo
	 *
	 * @return Invoice
	 */
	public function setPartnerRegNo( int $partnerRegNo ): Invoice {
		$this->partnerRegNo = $partnerRegNo;

		return $this;
}

	/**
	 * @param DateTimeInterface $dateCreate
	 *
	 * @return Invoice
	 */
	public function setDateCreate( DateTimeInterface $dateCreate ): Invoice {
		$this->dateCreate = $dateCreate;

		return $this;
}

	/**
	 * @param DateTimeInterface $dateDue
	 *
	 * @return Invoice
	 */
	public function setDateDue( DateTimeInterface $dateDue ): Invoice {
		$this->dateDue = $dateDue;

		return $this;
}

	/**
	 * @param DateTimeInterface $dateTax
	 *
	 * @return Invoice
	 */
	public function setDateTax( DateTimeInterface $dateTax ): Invoice {
		$this->dateTax = $dateTax;

		return $this;
}

	/**
	 * @param int $type
	 *
	 * @return Invoice
	 */
	public function setType( int $type ): Invoice {
		if(!isset(self::TYPES[$type])){
			throw new InvalidArgumentException('Invoice type with key \''.$type.'\' not exists.');
		}

		$this->type = $type;

		return $this;
}

	/**
	 * @return string
	 */
	public function getCode(): string {
		if($this->code === null){
			$this->code = self::CODES[$this->type];
		}
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getCodePrefix(): string {
		if($this->codePrefix === null){
			$this->codePrefix = self::CODES[$this->type];
		}
		return $this->codePrefix;
	}

	/**
	 * @param string $code
	 *
	 * @return Invoice
	 */
	public function setCode( string $code ): Invoice {
		$this->code = $code;

		return $this;
	}

	/**
	 * @param string $codePrefix
	 *
	 * @return Invoice
	 */
	public function setCodePrefix( string $codePrefix ): Invoice {
		$this->codePrefix = $codePrefix;

		return $this;
	}

	/**
	 * @param float $amount
	 *
	 * @return Invoice
	 */
	public function setAmount( float $amount ): Invoice {
		if($this->vat == 20){
			$this->base20 = round($amount / 1.2, 2);
			$this->amountVat20 = round($amount-$this->base20, 2);
		}
		if($this->vat == 0){
			$this->base20 = 0;
			$this->base = $amount;
		}

		$this->amount = round($amount,4);

		return $this;
	}

	/**
	 * @param int $vat
	 *
	 * @return Invoice
	 */
	public function setVat( int $vat ): Invoice {
		$this->vat = $vat;

		return $this;
	}

	/**
	 * @param string $subject
	 *
	 * @return Invoice
	 */
	public function setSubject( string $subject ): Invoice {
		$this->subject = $subject;

		return $this;
}

	/**
	 * @param int $vs
	 *
	 * @return Invoice
	 */
	public function setVs( int $vs ): Invoice {
		$this->vs = $vs;

		return $this;
}

	/**
	 * @param int $documentNumber
	 *
	 * @return Invoice
	 */
	public function setDocumentNumber( int $documentNumber ): Invoice {
		$this->documentNumber = $documentNumber;

		return $this;
}
}