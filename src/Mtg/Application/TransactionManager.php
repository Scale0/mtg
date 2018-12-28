<?php

namespace Mtg\Application;

interface TransactionManager
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;
}