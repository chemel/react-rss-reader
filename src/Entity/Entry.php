<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"entry:read"}},
 *      denormalizationContext={"groups"={"entry:write"}},
 *      collectionOperations={
 *          "get",
 *          "post",          
 *      },
 *      itemOperations={
 *          "get",
 *          "delete",
 *          "put",
 *          "patch",
 *          "readed"={
 *              "method"="GET",
 *              "path"="/entries/{id}/readed",
 *              "controller"=App\Controller\Api\EntryReaded::class
 *          }
 *      }
 * )
 * @ApiFilter(NumericFilter::class, properties={"feed.id"})
 * @ORM\Entity(repositoryClass="App\Repository\EntryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Entry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"entry:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"entry:read", "entry:write"})
     */
    private $date;

    /**
     * @ORM\Column(type="text")
     * @Groups({"entry:read", "entry:write"})
     */
   
    private $permalink;

    /**
     * @ORM\Column(type="text")
     * @Groups({"entry:read", "entry:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"entry:read", "entry:write"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"entry:read", "entry:write"})
     */
    private $hash;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"entry:read", "entry:write"})
     */
    private $readed;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"entry:read"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Feed", inversedBy="entries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPermalink(): ?string
    {
        return $this->permalink;
    }

    public function setPermalink(string $permalink): self
    {
        $this->permalink = $permalink;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getReaded(): ?\DateTimeInterface
    {
        return $this->readed;
    }

    public function setReaded(?\DateTimeInterface $readed): self
    {
        $this->readed = $readed;

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

    public function getFeed(): ?Feed
    {
        return $this->feed;
    }

    public function setFeed(?Feed $feed): self
    {
        $this->feed = $feed;

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
