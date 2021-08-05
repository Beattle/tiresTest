<?php

namespace App\Infrastructure\Operations\Product;

use App\Domain\AbstractProductOperation;
use App\Domain\Product\Import;
use App\Domain\Product\Values\ProductValuesTable;


final class ProductValuesType extends AbstractProductOperation implements Import
{
    public const PROP_NAME = 'property';

    /**
     * Метод получает замаппленные свойства на колонки в таблице
     * @param array $data
     * @return array
     */
    public function collectData(array $data) :array
    {
        $mappedData = $this->settings->get('import')['mappedData'];
        $propertiesType = array_column($this->mappedProperties->getPropertiesType(), 'Type', 'Name');

        foreach ($mappedData as  &$property) {
            if( array_key_exists ($property[self::PROP_NAME], $propertiesType)){
                $property['type'] = $propertiesType[$property[self::PROP_NAME]];
            }
        }
        $propertiesByType = array_column($mappedData, 'type',);

        return [];
    }

    /**
     * Основной метод который выполняется в Action
     * @param array $data
     */
    public function insertData(array $data): bool
    {
        $mappedData = $this->collectData($data);
        $this->makeSqlInsert($mappedData);
        return true;
    }

    /**
     * Вставляем значения дла таблиц вида property_value_$type
     * @param array $mappedData
     */
    public function makeSqlInsert(array $mappedData): void
    {
        foreach ($mappedData as $type => $values )
            $table = new ProductValuesTable();
            $name = $table->setType($type)->getName();
            $columns = implode(',', $table::columns);

        $sql = <<<SQL
        INSERT INTO $name $columns VALUES  $values;
SQL;
        $pdoStatement = $this->connection->prepare($sql);
        $pdoStatement->execute();
    }


}