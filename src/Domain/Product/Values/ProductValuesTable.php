<?php

namespace App\Domain\Product\Values;

use App\Domain\Product\Table;

class ProductValuesTable extends Table
{
    private string $name = 'property_value';

    public const columns = ['Value'];

    public function setType($type): ProductValuesTable
    {
        $this->name = "_$type";

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}