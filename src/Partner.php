<?php

namespace Kubomikita\Kros\Omega;

use Kubomikita\Kros\Omega\Attributes\Column;
use Kubomikita\Kros\Omega\Attributes\Required;

/**
 * @group T04
 */
final class Partner extends ExportItem {
	#[Column(1, required: true)]
	protected $ident = 'R01'; // 1
	#[Column(2, required: true)]
	protected $name; //2
	#[Column(3, required: true)]
	protected $regNo; //3
	#[Column(4, required: true)]
	protected $address; //4
	#[Column(5)]
	protected $zip; // 5
	#[Column(6)]
	protected $city; //6
	#[Column(8)]
	protected $state; //8
	#[Column(12)]
	protected $person; // 12
	#[Column(13)]
	protected $vatPayer; // 13
	#[Column(14)]
	protected $email; // 14
	#[Column(26)]
	protected $vatNo; // 26
	#[Column(27)]
	protected $taxNo;  //27

	/**
	* @param string $name
	*
	* @return Partner
	*/
	public function setName( string $name ): Partner {
		$this->name = $name;

		return $this;
	}

	/**
	 * @param int $regNo
	 *
	 * @return Partner
	 */
	public function setRegNo( int $regNo ): Partner {
		$this->regNo = $regNo;

		return $this;
	}

	/**
	 * @param string $address
	 *
	 * @return Partner
	 */
	public function setAddress( string $address ): Partner {
		$this->address = $address;

		return $this;
	}

	/**
	 * @param int $zip
	 *
	 * @return Partner
	 */
	public function setZip( string $zip ): Partner {
		$this->zip = $zip;

		return $this;
	}

	/**
	 * @param string $city
	 *
	 * @return Partner
	 */
	public function setCity( string $city ): Partner {
		$this->city = $city;

		return $this;
	}

	/**
	 * @param string $state
	 *
	 * @return Partner
	 */
	public function setState( string $state ): Partner {
		$this->state = $state;

		return $this;
	}

	/**
	 * @param bool $person
	 *
	 * @return Partner
	 */
	public function setPerson( bool $person ): Partner {
		$this->person = $person;

		return $this;
	}

	/**
	 * @param bool $vatPayer
	 *
	 * @return Partner
	 */
	public function setVatPayer( bool $vatPayer ): Partner {
		$this->vatPayer = $vatPayer;

		return $this;
	}

	/**
	 * @param string $email
	 *
	 * @return Partner
	 */
	public function setEmail( string $email ): Partner {
		$this->email = $email;

		return $this;
	}

	/**
	 * @param string $vatNo
	 *
	 * @return Partner
	 */
	public function setVatNo( ?string $vatNo = null ): Partner {
		$this->vatNo = $vatNo;

		return $this;
	}

	/**
	 * @param int $taxNo
	 *
	 * @return Partner
	 */
	public function setTaxNo( ?int $taxNo = null ): Partner {
		$this->taxNo = $taxNo;

		return $this;
	}


}