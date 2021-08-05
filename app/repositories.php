<?php
declare(strict_types=1);



use App\Infrastructure\Operations\File\File;
use App\Infrastructure\Operations\Product\ProductCatalog;
use App\Infrastructure\Operations\Product\ProductProperty;
use App\Infrastructure\Operations\Product\ProductValuesType;
use App\Infrastructure\Persistence\Reference\MappedProperties;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        MappedProperties::class => \DI\autowire(MappedProperties::class),
        File::class => \DI\autowire(File::class),
        ProductCatalog::class => \DI\autowire(ProductCatalog::class),
        ProductProperty::class => \DI\autowire(ProductProperty::class),
        ProductValuesType::class => \DI\autowire(ProductValuesType::class)
    ]);
};
