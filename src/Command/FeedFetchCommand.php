<?php

namespace App\Command;

use App\Entity\Feed;
use App\Entity\Entry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FeedFetchCommand extends Command
{
    protected static $defaultName = 'app:feed:fetch';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch all feeds')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $feedRepository = $this->em->getRepository(Feed::class);
        $entryRepository = $this->em->getRepository(Entry::class);

        $feeds = $feedRepository->findAll();
        shuffle($feeds);

        foreach($feeds as $feed) {
            $output->writeln(($feed->getUrl()));

            $sp = new \SimplePie();
            $sp->set_feed_url($feed->getUrl());
            $sp->set_cache_location(__DIR__.'/../../var/cache');
            $sp->init();

            $items = $sp->get_items();

            foreach ($items as $item) {
                $hash = $item->get_id(true);

                $exist = $entryRepository->exists($feed, $hash);

                if(!$exist) {
                    $entry = new Entry();
                    $entry->setTitle($item->get_title());
                    $entry->setPermalink($item->get_permalink());
                    $entry->setDate(new \DateTime($item->get_date('Y-m-d h:i:s')));
                    $entry->setContent($item->get_description());
                    $entry->setHash($hash);
                    $entry->setFeed($feed);
    
                    $this->em->persist($entry);
                }
            }

            $this->em->flush();
        }

        return 0;
    }
}
