<?php

namespace Kubomikita\Kros\Omega;

/**
 * @group T04
 */
final class Partner extends ExportItem {
	/**
	 * @column 1
	 * @var string
	 */
	protected $ident = 'R01'; // 1

	/**
	 * @required
	 * @column 2
	 * @var string
	 */
	protected $name; //2
	/**
	 * @required
	 * @column 3
	 * @var int
	 */
	protected $regNo; //3
	/**
	 * @required
	 * @column 4
	 * @var string
	 */
	protected $address; //4
	/**
	 * @column 5
	 * @var int
	 */
	protected $zip; // 5
	/**
	 * @column 6
	 * @var string
	 */
	protected $city; //6
	/**
	 * @column 8
	 * @var string
	 */
	protected $state; //8
	/**
	 * @column 12
	 * @var bool
	 */
	protected $person; // 12
	/**
	 * @column 13
	 * @var bool
	 */
	protected $vatPayer; // 13
	/**
	 * @column 14
	 * @var string
	 */
	protected $email; // 14
	/**
	 * @column 26
	 * @var string
	 */
	protected $vatNo; // 26
	/**
	 * @column 27
	 * @var int
	 */
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
	public function setZip( int $zip ): Partner {
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
	public function setVatNo( string $vatNo ): Partner {
		$this->vatNo = $vatNo;

		return $this;
	}

	/**
	 * @param int $taxNo
	 *
	 * @return Partner
	 */
	public function setTaxNo( int $taxNo ): Partner {
		$this->taxNo = $taxNo;

		return $this;
	}


}