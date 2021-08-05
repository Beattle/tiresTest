<?php

namespace App\Domain\Product;

class ProductCatalogTable extends Table
{
    private string $name = 'productcatalog';
    public const COLUMNS = [
        'VendorID',
        'VendorCode',
        'rrc',
        'ProductCategoryID',
        'Name',
        'ModelID',
        'price'];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}