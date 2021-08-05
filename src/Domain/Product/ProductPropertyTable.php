<?php

namespace App\Domain\Product;

class ProductPropertyTable extends Table
{
    private string $name = 'product_property';

    public const COLUMNS = ['ProductPropertyID', 'ProductCatalogItemID', 'ValueID'];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}