<?php
/**
 * Created by PhpStorm.
 * User: sjoerddewaard
 * Date: 03/11/2018
 * Time: 13:49
 */

namespace Mtg\Application;

interface TransactionManager
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;
}