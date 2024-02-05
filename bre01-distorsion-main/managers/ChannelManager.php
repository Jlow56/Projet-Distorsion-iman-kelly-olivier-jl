<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class ChannelManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Category $category
     * @return array
     */
    public function findByCategory(Category $category) : array
    {
        $query = $this->db->prepare('SELECT * FROM channels WHERE category_id=:category_id');
        $parameters = [
          "category_id" => $category->getId()
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $channels = [];

        foreach($result as $item)
        {
            $channel = new Channel($item["name"], $category);
            $channel->setId($item["id"]);
            $channels[] = $channel;
        }

        return $channels;
    }

    public function findOne(int $id) : Channel
    {
        $query = $this->db->prepare('SELECT * FROM channels WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $cm = new CategoryManager();
        $channel = new Channel($result["name"], $cm->findOne(intval($result["category_id"])));
        $channel->setId($result["id"]);

        return $channel;
    }

    /**
     * @param Channel $channel
     * @return void
     */
    public function rename(Channel $channel) : void
    {

    }

    /**
     * @param Channel $channel
     * @return void
     */
    public function create(Channel $channel) : void
    {
        $query = $this->db->prepare('INSERT INTO channels (id, name, category_id) VALUES (NULL, :name, :category_id)');
        $parameters = [
            "name" => $channel->getName(),
            "category_id" => $channel->getCategory()->getId()
        ];

        $query->execute($parameters);

        $channel->setId($this->db->lastInsertId());
    }

    /**
     * @param Channel $channel
     * @return void
     */
    public function delete(Channel $channel) : void
    {

    }
}