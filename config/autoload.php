
<?php
require "connexion.php";



spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
?>

// Category.php
<?php
class Category
{
    private $id;
    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
?>

// Salon.php
<?php
class Salon
{
    private $id;
    private $name;
    private $categoryId; // clé étrangère

    public function __construct($id, $name, $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
?>