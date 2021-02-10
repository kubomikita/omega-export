<?php

namespace Kubomikita\Kros\Omega;


final class InvoiceList extends ExportList {
	public function getHeader() : array {
		return['R00', 'T01'];
	}

	public function createItem(): Invoice {
		return $this->items[] = (new Invoice());
	}

	public function createInvoice() : Invoice {
		return $this->createItem();
	}

	public function createInvoiceItem() : InvoiceItem {
		return $this->items[] = (new InvoiceItem());
	}
}