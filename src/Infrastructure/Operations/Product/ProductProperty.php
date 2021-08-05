<?php

namespace App\Infrastructure\Operations\Product;

use App\Domain\AbstractProductOperation;
use App\Domain\Product\Import;
use App\Domain\Product\ProductCatalogTable;
use App\Domain\Product\ProductPropertyTable;

final class ProductProperty extends AbstractProductOperation implements Import
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
        $table = new ProductPropertyTable();
        $name = $table->getName();
        $union ='';
        // Составляем запрос для каждого товара  из таблицы
        foreach ($values as $row)
            // Для каждого необходимого свойства отдельный цикл
            foreach ($row as $needed_property){
            $union .= <<<SQL
        SELECT prop.ProductPropertyID, prop.ProductCatalogItemdID, prop.ValueID 
            FROM (
                SELECT pp.id as ProductPropertyID
                FROM `product_property` as pp WHERE code = $needed_property[Name]
                UNION SELECT ProductCatalogItemdID FROM productcatalog
                WHERE Name = $row[Name]
                UNION SELECT pv.id as ValueID FROM property_value_$needed_property[Type] as pv
                WHERE Value = $needed_property[Value]                                             
                ) as prop
SQL;
            }
        $columns = $table::COLUMNS;
        $sql = <<<SQL
INSERT INTO $name $columns     
$union
SQL;
        $pdoStatement = $this->connection->prepare($sql);
        $pdoStatement->execute();

    }
}