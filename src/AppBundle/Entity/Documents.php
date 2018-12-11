<?php

namespace AppBundle\Entity;

/**
 * Documents
 */
class Documents
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var \AppBundle\Entity\Media
     */
    private $media;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Documents
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Documents
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return Documents
     */
    public function setMedia(\AppBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
}

