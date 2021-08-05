<?php

namespace App\Infrastructure\Operations\Product;

use App\Domain\AbstractProductOperation;
use App\Domain\Product\Import;
use App\Domain\Product\ProductCatalogTable;

final class ProductCatalog extends AbstractProductOperation implements Import
{

    /**
     *
     */
    public function insertData(array $data)
    {
        $values = $this->collectData($data);
        // TODO: Implement insertData() method.

        $this->makeSqlInsert($values);

    }

    /**
     *
     * Собираем данные для товара
     * @param array $data
     */
    protected function collectData(array $data): array
    {

        return $values = [];
        // TODO: Implement collectData() method.
    }

    private function makeSqlInsert($values)
    {
        $table = new ProductCatalogTable();
        $name = $table->getName();
        $columns = $table::COLUMNS;
        $sql = <<<SQL
INSERT INTO $name $columns $values
SQL;

    }
}