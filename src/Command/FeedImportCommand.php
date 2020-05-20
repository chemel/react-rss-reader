<?php

namespace App\Command;

use App\Entity\Feed;
use App\Entity\FeedCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FeedImportCommand extends Command
{
    protected static $defaultName = 'app:feed:import';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import a OPML file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // The file to import
        $filename = realpath(__DIR__.'/../../storage/subscriptions.opml');

        // Parse the xml file
        $xml = new \SimpleXMLElement(file_get_contents($filename));

        // Get Feed & Category repository
        $feedRepository = $this->em->getRepository(Feed::class);
        $feedCategoryRepository = $this->em->getRepository(FeedCategory::class);
        // Caching all categories
        $feedCategoryRepository->findAll();

        // Foreach Categories
        foreach($xml->body->outline as $xmlNodeCategory) {

            $attributes = $xmlNodeCategory->attributes();

            $categoryTitle = trim((string) $attributes->title);

            $output->writeLn('');
            $output->writeLn('Category : ' . $categoryTitle);

            // Check if category exist
            $category = $feedCategoryRepository->findOneBy(['name' => $categoryTitle]);

            // If not exist, create it !
            if(!$category) {
                $category = new FeedCategory();
                $category->setName($categoryTitle);
                $this->em->persist($category);
                $this->em->flush();
            }

            // Foreach Feeds
            foreach($xmlNodeCategory->outline as $xmlNodeFeed) {
                $attributes = $xmlNodeFeed->attributes();

                // The url of the feed
                $url = (string) $attributes->xmlUrl;

                // Check if the Feed exist in the database
                $exist = $feedRepository->existByUrl($url);

                if(!$exist) {
                    $output->writeLn($url);

                    // Create the Feed
                    $feed = new Feed();
                    $feed->setTitle((string) $attributes->title);
                    $feed->setUrl($url);

                    $feed->setCategory($category);
    
                    // Save the Feed in database
                    $this->em->persist($feed);
                }
            }

            $this->em->flush();
        }

        return 0;
    }
}
