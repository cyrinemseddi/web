<?php


namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ArticleRepository::class)]
    
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank(message: "veuillez saisir le nom de l'article")]
    #[Assert\Length(min:2,minMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    #[Assert\Length(max:4,maxMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    #[Assert\ExpressionLanguageSyntax(message:"Votre champ contient des caractére spec.")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "veuillez ajouter l'image de l'article")]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "veuillez ajouter une desription de l'article")]
    #[Assert\Length(min:2,minMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    #[Assert\Length(max:10,maxMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "veuillez ajouter le prix de l'article")]
    #[Assert\Length(min:2,minMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    #[Assert\Length(max:10,maxMessage:"Votre champ ne contient pas {{
        limit }} caractères.")]
    #[Assert\Positive]
    private ?int $prix = null;

    #[ORM\OneToMany(mappedBy: 'article', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function __toString(){
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setArticle($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getArticle() === $this) {
                $commentaire->setArticle(null);
            }
        }

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }



    
}