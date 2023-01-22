<?php

namespace Kubomikita\Kros\Omega;


final class PartnerList extends ExportList {
	public function getHeader() : array
	{
		return['R00', 'T04'];
	}

	public function createItem(): Partner
	{
		return $this->items[] = (new Partner());
	}

	public function createPartner() : Partner
	{
		return $this->createItem();
	}
}