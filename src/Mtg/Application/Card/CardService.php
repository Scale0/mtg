<?php
declare(strict_types = 1);

namespace Mtg\Application\Card;

use Mtg\Domain\Model\Card\CardRepositoryInterface;

class CardService
{
    /**
     * @var CardRepositoryInterface
     */
    private $cardRepository;

    /**
     * CardService constructor.
     *
     * @param CardRepositoryInterface $cardRepository
     */
    public function __construct(CardRepositoryInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

}