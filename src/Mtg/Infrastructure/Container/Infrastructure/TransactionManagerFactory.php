<?php
declare(strict_types = 1);

namespace Mtg\Infrastructure\Container\Infrastructure;

use Infrastructure\Persistence\Doctrine\DoctrineORMTransactionManager;
use Mtg\Application\TransactionManager;
use Psr\Container\ContainerInterface;

/**
 * Class TransactionManagerFactory
 *
 * @package Codeliner\CargoBackend\Infrastructure\Persistence\Transaction
 * @author Alexander Miertsch <contact@prooph.de>
 */
final class TransactionManagerFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @return TransactionManager
     */
    public function __invoke(ContainerInterface $container): TransactionManager
    {
        return new DoctrineORMTransactionManager($container->get('doctrine.entitymanager.orm_default'));
    }
}
