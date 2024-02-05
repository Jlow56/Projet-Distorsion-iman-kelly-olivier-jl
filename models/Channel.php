<?php
class Channel {
    
    private ?int $id = null;
 
	public function __construct(private string $name, private int $id_category)
	{
   
	}

	public function getId() : int 
	{
		return $this->id;
	}

	public function setId(int $id) : void 
	{
		$this->id = $id;
	}

	public function getName() : string 
	{
		return $this->name;
	}

	public function setName(string $name) : void 
	{
		$this->username = $name;
	}

    public function getId_category(): DateTime
    {
        return $this->Id_category;
    }

    public function setId_category(int $id_category): void
    {
        $this->createdAt = $id_category;
    }
}