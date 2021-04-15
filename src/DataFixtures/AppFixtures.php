<?php

namespace App\DataFixtures;

use App\Entity\Feed;
use App\Entity\FeedCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new FeedCategory();
        $category->setName('Informatique');
        $manager->persist($category);

        $feed = new Feed();
        $feed->setTitle('Korben');
        $feed->setUrl('https://korben.info/feed');
        $feed->setCategory($category);
        $manager->persist($feed);

        $feed = new Feed();
        $feed->setTitle('Pixels');
        $feed->setUrl('https://www.lemonde.fr/pixels/rss_full.xml');
        $feed->setCategory($category);
        $manager->persist($feed);

        $manager->flush();
    }
}
