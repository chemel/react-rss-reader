<?php

namespace App\Controller\Api;

use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;

class EntryReaded
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(Entry $data): array
    {
        $entry = $data;

        if($entry->getReaded() === null) {
            $entry->setReaded(new \DateTime());
            $this->em->persist($entry);
            $this->em->flush();
        }

        return [$entry];
    }
}
