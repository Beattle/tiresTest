<?php

namespace App\Domain;


use App\Application\Settings\SettingsInterface;
use App\Infrastructure\Persistence\Reference\MappedProperties;
use PDO;

abstract class AbstractProductOperation
{
    protected PDO $connection;
    protected MappedProperties $mappedProperties;
    protected SettingsInterface $settings;

    public function __construct(PDO               $connection,
                                MappedProperties  $mappedProperties,
                                SettingsInterface $settings)
    {
        $this->connection = $connection;
        $this->mappedProperties = $mappedProperties;
        $this->settings = $settings;
    }
    abstract protected function collectData(array $data);

}