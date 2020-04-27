<?php

namespace App\Controller\Api;

use App\Entity\Feed;
use App\Repository\EntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FeedEntryExists {

    private $repository;

    public function __construct(EntryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Feed $data, Request $request): array
    {
       $hash = $request->get('hash');

       return [
           "exists" => $this->repository->exists($hash),
       ];
    }
}