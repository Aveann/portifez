<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortifRepository")
 */
class Portif
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
     * @ORM\Column(type="string", length=255, nullable=true)
	 	 * @Assert\File(
     *		maxSize = "5M",
	 *		maxSizeMessage = "Le fichier est trop gros ({{ size }} {{ suffix }}). La taille maximum autorisée est {{ limit }} {{ suffix }}",
	 *  	mimeTypes={"image/jpeg", "image/png", "image/jpg", "image/gif"},
	 *		mimeTypesMessage = "Veuillez charger une image valide (jpeg, png, gif)."
	 * )
     */
    private $illustration;
	
	/**
     * @ORM\Column(type="text", nullable=true)
     */
	private $about;
	
	/**
     * @var \DateTime $created
     * @ORM\Column(type="datetime")
     */
    private $created;
	
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="portif", orphanRemoval=true)
     */
    private $posts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="portifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean")
     */
    private $illustration_activated;


    public function __construct()
    {
		$this->created= new \DateTime();
        $this->posts = new ArrayCollection();
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

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }
	
	 public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }
	
	public function getCreated()
             {
                 return $this->created;
             }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setPortif($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getPortif() === $this) {
                $post->setPortif(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIllustrationActivated(): ?bool
    {
        return $this->illustration_activated;
    }

    public function setIllustrationActivated(bool $illustration_activated): self
    {
        $this->illustration_activated = $illustration_activated;

        return $this;
    }
}
