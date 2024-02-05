<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Category
{
    private ? int $id = null;

    /**
     * @param string $name
     */
    public function __construct(private string $name)
    {

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray() : array
    {
        return [
          "id" => $this->id,
          "name" => $this->name
        ];
    }
}