<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var \DateTime $created
     * @ORM\Column(type="datetime")
     */
    private $created;
	
	/**
     * @var \DateTime $updated
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Portif", inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portif;

	public function __construct()
    {
        $this->created= new \DateTime();
        $this->updated= new \DateTime();
    }
	
	/**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updated= new \DateTime();
    }
	
    public function getId(): ?int
    {
        return $this->id;
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

	
    public function getCreated()
    {
        return $this->created;
    }
	
	public function getUpdated()
	{
		return $this->updated;
	}

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

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

    public function getPortif(): ?Portif
    {
        return $this->portif;
    }

    public function setPortif(?Portif $portif): self
    {
        $this->portif = $portif;

        return $this;
    }
}
