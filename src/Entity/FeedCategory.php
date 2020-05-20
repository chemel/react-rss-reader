<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FeedCategoryRepository")
 */
class FeedCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Feed", mappedBy="category")
     */
    private $feed;

    public function __construct()
    {
        $this->feed = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Feed[]
     */
    public function getFeed(): Collection
    {
        return $this->feed;
    }

    public function addFeed(Feed $feed): self
    {
        if (!$this->feed->contains($feed)) {
            $this->feed[] = $feed;
            $feed->setCategory($this);
        }

        return $this;
    }

    public function removeFeed(Feed $feed): self
    {
        if ($this->feed->contains($feed)) {
            $this->feed->removeElement($feed);
            // set the owning side to null (unless already changed)
            if ($feed->getCategory() === $this) {
                $feed->setCategory(null);
            }
        }

        return $this;
    }
}
