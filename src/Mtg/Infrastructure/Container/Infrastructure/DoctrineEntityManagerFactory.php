<?php
declare(strict_types = 1);

namespace Mtg\Infrastructure\Container\Infrastructure;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

final class DoctrineEntityManagerFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function __invoke(ContainerInterface $container): EntityManager
    {
        $appConfig = $container->get('config');

        if (!isset($appConfig['doctrine']['connection']['orm_default'])) {
            throw new \RuntimeException("Missing doctrine connection config for orm_default driver");
        }

        $config = new \Doctrine\Orm\Configuration();

        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyDir('data/cache');
        $config->setProxyNamespace('Mtg\Doctrine\Entities');
        $config->setMetadataDriverImpl(
            new \Doctrine\ORM\Mapping\Driver\XmlDriver(
                array(
                    __DIR__ . '/../../Persistence/Doctrine/ORM'
                )
            )
        );
        $config->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());

        $config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache());
        $config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache());

        $entityManager = \Doctrine\ORM\EntityManager::create($appConfig['doctrine']['connection']['orm_default'], $config);

        return $entityManager;
    }
}