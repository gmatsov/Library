<?php


namespace App\DTO;

use app\vendor\BarcodeValidator;

class BookDTO
{
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
    private $isbn;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $image;
    /**
     * @var string
     */
    private $image_src;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws \Exception
     */
    public function setName($name)
    {
        if (strlen($name) < 2) {
            throw  new \Exception(' Name must be from at least 2 symbols length');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     * @throws \Exception
     */
    public function setIsbn($isbn)
    {
        if (!BarcodeValidator::IsValidISBN($isbn)) {
            throw  new \Exception('Invalid ISBN');
        }
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImageSrc()
    {
        return $this->image_src;
    }

    /**
     * @param string $image_src
     */
    public function setImageSrc($image_src): void
    {
        $this->image_src = $image_src;
    }
}