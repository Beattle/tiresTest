<?php

namespace App\Application\Actions\Import;

use App\Application\Settings\SettingsInterface;
use App\Infrastructure\Operations\File\File;
use App\Infrastructure\Operations\Product\ProductCatalog;
use App\Infrastructure\Operations\Product\ProductProperty;
use App\Infrastructure\Operations\Product\ProductValuesType;
use Psr\Container\ContainerInterface;


class importAction
{

    private File $file;
    private ContainerInterface $container;

    public function __construct(
        ContainerInterface $container,
        File              $file
    )
    {
        $this->file = $file;
        $this->container = $container;
    }

    public function import(): array
    {
        $fileData = $this->file->getCsvData();
        $operations = $this->container->get(SettingsInterface::class)->get('import')['operations'];
        foreach ($operations as $operation){
            $this->container->get($operation)->insertData($fileData);
        }
        return [];
    }

    private function getFileData()
    {

    }
}