<?php

namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Post
{

    private $id;

    private $slug;

    private $name;

    private $content;

    private $created_at;

    private $category;

    private $image;

    private $link;
    
    /**
     * Return name of a post
     *
     * @return string name of post
     */
    public function getName(): ?string
    {
        return htmlentities($this->name);
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    
    /**
     * Return creation time of post
     *
     * @return DateTime get created time of post
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at); 
    }
    
    /**
     * Return url of post
     *
     * @return string url of post
     */
    public function getSlug(): ?string {
        return $this->slug;
    }
    
    /**
     * Return id of post
     *
     * @return int id of post
     */
    public function getID(): ?int
    {
        return $this->id;
    }
        
    /**
     * setID
     *
     * @param  int $id
     * @return void
     */
    public function setID(int $id): self
    {
        $this->$id = $id;
        return $this;
    }
    
    /**
     * Return formatted content of post
     *
     * @return string formatted content of post
     */
    public function getFormattedContent(): ?string
    {
        return nl2br(htmlentities($this->content));
    }
    
    /**
     * Modify post name
     *
     * @param  string $name new post name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Modify post content
     *
     * @param  string $content new post content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
    
    /**
     * setSlug
     *
     * @param  string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
    
    /**
     * setCreatedAt
     *
     * @param  string $date
     * @return self
     */
    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the value of img
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link): self
    {
        $this->link = $link;
        return $this;
    }
}
