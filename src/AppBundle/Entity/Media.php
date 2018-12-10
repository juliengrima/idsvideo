<?php

namespace AppBundle\Entity;

/**
 * Media
 */
class Media
{

    // Variable temporaire pour upload de fichier
    private $file;

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($picture)
    {
        $this->file = $picture;
        return $this;
    }


    function __toString()
    {
        return $this->getName() . " | " . $this->getPath();
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * Get id
     *
     * @return int
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
     * @return Media
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
     * Set path
     *
     * @param string $path
     *
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    /**
     * @var string
     */
    private $comment;


    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Media
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
}
