<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Channel
{
    private ? int $id = null;

    /**
     * @param string $name
     * @param Category $category
     */
    public function __construct(private string $name, private Category $category)
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

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function toArray() : array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "category" => $this->category->getId()
        ];
    }
}