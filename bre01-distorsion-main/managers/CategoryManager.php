<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CategoryManager extends AbstractManager
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach($result as $item)
        {
            $category = new Category($item["name"]);
            $category->setId($item["id"]);
            $categories[] = $category;
        }

        return $categories;
    }

    /**
     * @param string $name
     * @return Category|null
     */
    public function findOne(int $id) : ? Category
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
        $item = $query->fetch(PDO::FETCH_ASSOC);

        if($item)
        {
            $category = new Category($item["name"]);
            $category->setId($item["id"]);

            return $category;
        }

        return null;
    }

    /**
     * @param Category $category
     * @return void
     */
    public function create(Category $category) : void
    {
        $query = $this->db->prepare('INSERT INTO categories (id, name) VALUES (NULL, :name)');
        $parameters = [
            "name" => $category->getName(),
        ];

        $query->execute($parameters);

        $category->setId($this->db->lastInsertId());
    }
}