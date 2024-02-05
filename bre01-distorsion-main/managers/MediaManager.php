<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class MediaManager extends AbstractManager
{
    public function create(Media $media)
    {
        $currentDate = date('Y-m-d H:i:s');

        $query = $this->db->prepare('INSERT INTO media (id, name, url) VALUES (NULL, :name, :url)');
        $parameters = [
            "name" => $media->getName(),
            "url" => $media->getUrl(),
        ];

        $query->execute($parameters);

        $media->setId($this->db->lastInsertId());
    }

    public function findOne(int $id) : ? Media
    {
        $query = $this->db->prepare('SELECT * FROM media WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $media = new Media($result["name"], $result["url"]);
        $media->setId($result["id"]);

        return $media;
    }
}