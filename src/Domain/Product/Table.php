<?php

namespace App\Domain\Product;

abstract class Table
{
    private string $name = '';

    public const COLUMNS = [];

    abstract public function getName();

}