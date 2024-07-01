<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    public ?Branche $branch = null;

    #[ORM\OneToMany(mappedBy: 'course', targetEntity: Video::class, cascade: ["remove"])]
    public Collection $videos;


    #[ORM\Column(length: 255)]
    public ?string $learning_path = null;

    #[ORM\Column(length: 255)]
    public ?string $niveau = null;

    #[ORM\Column(length: 255)]
    public ?string $durence = null;

    #[ORM\Column(length: 255)]
    public ?string $start = null;

    #[ORM\Column(length: 255)]
    public ?string $img = null;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBranch(): ?Branche
    {
        return $this->branch;
    }

    public function setBranch(?Branche $branch): static
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setCourse($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getCourse() === $this) {
                $video->setCourse(null);
            }
        }

        return $this;
    }

    public function getLearningPath(): ?string
    {
        return $this->learning_path;
    }

    public function setLearningPath(string $learning_path): static
    {
        $this->learning_path = $learning_path;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDurence(): ?string
    {
        return $this->durence;
    }

    public function setDurence(string $durence): static
    {
        $this->durence = $durence;

        return $this;
    }

    public function getStart(): ?string
    {
        return $this->start;
    }

    public function setStart(string $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }
}
