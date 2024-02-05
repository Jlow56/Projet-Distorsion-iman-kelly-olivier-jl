<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class MessageManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findByChannel(int $channelId) : array
    {
        $query = $this->db->prepare('SELECT * FROM messages WHERE channel_id=:channel_id');
        $parameters = [
            "channel_id" => $channelId
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $messages = [];

        foreach($result as $item)
        {
            $um = new UserManager();
            $cm = new ChannelManager();

            $user = $um->findOne(intval($item["user_id"]));
            $channel = $cm->findOne(intval($item["channel_id"]));
            $message = new Message($item["content"], $channel, $user, DateTime::createFromFormat("Y-m-d H:i:s", $item["created_at"]));
            $messages[] = $message;
        }

        return $messages;
    }

    public function create(Message $message) : void
    {
        $currentDate = date('Y-m-d H:i:s');

        $query = $this->db->prepare('INSERT INTO messages (id, content, channel_id, user_id, created_at) VALUES (NULL, :content, :channel_id, :user_id, :created_at)');
        $parameters = [
            "content" => $message->getContent(),
            "channel_id" => $message->getChannel()->getId(),
            "user_id" => $message->getUser()->getId(),
            "created_at" => $currentDate
        ];

        $query->execute($parameters);

        $message->setId($this->db->lastInsertId());
    }

    public function delete(Message $message) : void
    {

    }
}