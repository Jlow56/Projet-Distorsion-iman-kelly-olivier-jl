<?php
class Messages {
    
    private ?int $id = null;
 
	public function __construct(private string $name, private DateTime $createdAt)
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

    public function getCreated_at(): DateTime
    {
        return $this->created_at;
    }

    public function setCreated_at(DateTime $create_at): void
    {
        $this->created_at = $create_at;
    }
}