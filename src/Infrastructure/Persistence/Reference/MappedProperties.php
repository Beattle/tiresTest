<?php

namespace App\Infrastructure\Persistence\Reference;

use PDO;

class MappedProperties
{
    private ?array $propertiesType;
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->propertiesType = $this->selectMapped()?: null;
    }

    private function selectMapped() :array
    {
        $sql = <<<SQL
SELECT pp.code as Name, ppt.code as Type
FROM `product_property` as pp
JOIN product_property_type as ppt
    ON pp.PropertyTypeID = ppt.id 
SQL;
        $pdoStatement = $this->connection->prepare($sql);
        $pdoStatement->execute();
        return $pdoStatement->fetchAll();

    }

    /**
     * @return array|null
     */
    public function getPropertiesType(): ?array
    {
        return $this->propertiesType;
    }


}