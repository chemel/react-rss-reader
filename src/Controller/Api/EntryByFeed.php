<?php

namespace App\Controller\Api;

use App\Entity\Feed;
use App\Repository\EntryRepository;

class EntryByFeed
{

    private $repository;

    public function __construct(EntryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Feed $data): array
    {
        $feed = $data;

        $entries = $this->repository->findByFeed($feed);

        return $entries;
    }
}
