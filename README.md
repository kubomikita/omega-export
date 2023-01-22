# Export helper for Omega Kros
Export helper for Kros Omega 
## Install
```
composer require kubomikita/omega-export
```
## Example usage of partner export
```php
use Kubomikita\Kros\Omega\Partner;
use Kubomikita\Kros\Omega\PartnerList;

$list = new PartnerList();

$list->createItem()
      ->setName($client->name)
      ->setRegNo($client->ico)
      ->setAddress($client->address)
      ->setZip((string) $client->zip)
      ->setCity($client->city)
      ->setState($client->country)
      ->setVatNo($client->ic_dph)
      ->setVatPayer($client->ic_dph !== null)
      ->setPerson(false)
      ->setTaxNo($client->dic);
      

$output = $list->getData(); // get arrray of txt rows

```
