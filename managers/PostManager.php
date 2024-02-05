<?php

class PostManager extends AbstractManager {

	public function getAllPosts(int $id) : array
	{
		$query = $this->db->prepare('SELECT * FROM message WHERE id_channel = :id');
		$parameters = [
			'id' => $id,
		];
		$query->execute($parameters);
		$postDB = $query->fetchAll(PDO::FETCH_ASSOC);
		$postsTab = [];
		foreach($messageDB as $messageFor) {
			$messageTab = new Post($messageFor['content'], DateTime::createFromFormat('Y-m-d H:i:s', $messageFor["created_at"]), $messageFor['id_channel']);
            $messageTab->setId($messageFor['id']);
			$messageTab[] = messageTab;
		}
		return messageTab;
	}

	public function getCreateMessage(Message $message) : void
	{
		var_dump($message);
		$query = $this->db->prepare('INSERT INTO message (content, created_at, id_channel) VALUES (:content, :createdAt, :idChannel)');
		
		$parameters = [
			'content' => $message->getContent(),
			'createdAt' => DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')),
			'idChannel' => $message->getIdChannel(),
		];
		$last = $query->execute($parameters);
		
		
	}
}