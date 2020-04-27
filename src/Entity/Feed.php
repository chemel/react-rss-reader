<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"feed:read", "entry:read"}},
 *      denormalizationContext={"groups"={"feed:write"}},
 *      collectionOperations={
 *          "get",
 *          "post",
 *          
 *      },
 *      itemOperations={
 *          "get",
 *          "delete",
 *          "put",
 *          "patch",
 *          "entry_exists"={
 *              "method"="GET",
 *              "path"="/feeds/{id}/entry/exists",
 *              "controller"=App\Controller\Api\FeedEntryExists::class
 *          },
 *          "get_entries"={
 *              "method"="GET",
 *              "path"="/feed/{id}/entries",
 *              "controller"=App\Controller\Api\EntryByFeed::class
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\FeedRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Feed
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"feed:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"feed:read", "feed:write"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"feed:read", "feed:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"feed:read", "feed:write"})
     */
    private $enabled;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"feed:read", "feed:write"})
     */
    private $fetched_at;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"feed:read"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entry", mappedBy="feed", orphanRemoval=true)
     */
    private $entries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getFetchedAt(): ?\DateTimeInterface
    {
        return $this->fetched_at;
    }

    public function setFetchedAt(?\DateTimeInterface $fetched_at): self
    {
        $this->fetched_at = $fetched_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Entry[]
     */
    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function addEntry(Entry $entry): self
    {
        if (!$this->entries->contains($entry)) {
            $this->entries[] = $entry;
            $entry->setFeed($this);
        }

        return $this;
    }

    public function removeEntry(Entry $entry): self
    {
        if ($this->entries->contains($entry)) {
            $this->entries->removeElement($entry);
            // set the owning side to null (unless already changed)
            if ($entry->getFeed() === $this) {
                $entry->setFeed(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
}
