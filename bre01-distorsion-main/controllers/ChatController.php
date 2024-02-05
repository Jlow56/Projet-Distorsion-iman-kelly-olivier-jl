<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class ChatController extends AbstractController
{
    private CategoryManager $catM;
    private ChannelManager $chanM;
    private MessageManager $mm;
    private UserManager $um;

    public function __construct()
    {
        $this->chanM = new ChannelManager();
        $this->catM = new CategoryManager();
        $this->mm = new MessageManager();
        $this->um = new UserManager();
    }

    public function chat() : void
    {
        $categories = $this->catM->findAll();
        $list = [];

        foreach($categories as $category)
        {
            $item = [];
            $item["category"] = $category;
            $item["channels"] = $this->chanM->findByCategory($category);
            $list[] = $item;
        }

        $this->render("chat", [
            "categories" => $list
        ]);
    }

    public function channel(string $channelId) : void
    {
        $messageList = $this->mm->findByChannel(intval($channelId));
        $messages = [];

        foreach($messageList as $item)
        {
            $message = $item->toArray();
            $messages[] = $message;
        }

        if(count($messages) > 0)
        {
            $this->renderJson(["status" => "OK", "messages" => $messages, "channel" => $messageList[0]->getChannel()->toArray()]);
        }
        else
        {
            $this->renderJson(["status" => "OK", "messages" => $messages, "channel" => $this->chanM->findOne(intval($channelId))->toArray()]);
        }


    }

    public function createCategory() : void
    {
        if(isset($_POST["cat-name"]))
        {
            $category = new Category($_POST["cat-name"]);
            $this->catM->create($category);
            $this->renderJson(["status" => "OK", "category" => $category->toArray()]);
        }
        else
        {
            $this->renderJson(["status" => "NOK", "errors" => ["Missing Category name"]]);
        }
    }

    public function createChannel() : void
    {
        if(isset($_POST["cat-id"]) && isset($_POST["chan-name"]))
        {
            $category = $this->catM->findOne(intval($_POST["cat-id"]));
            $channel = new Channel($_POST["chan-name"], $category);

            $this->chanM->create($channel);

            $this->renderJson(["status" => "OK", "channel" => $channel->toArray()]);
        }
        else
        {
            $errors = [];

            if(!isset($_POST["chan-name"]))
            {
                $errors[] = "Missing channel name";
            }

            if(!isset($_POST["cat-id"]))
            {
                $errors[] = "Missing category id";
            }

            $this->renderJson(["status" => "NOK", "errors" => $errors]);
        }

    }

    public function sendMessage()
    {
        if(isset($_POST["chan-id"]) && $_POST["message"])
        {
            $user = $this->um->findOne($_SESSION["user"]);
            $channel = $this->chanM->findOne(intval($_POST["chan-id"]));
            $message = new Message($_POST["message"], $channel, $user, new DateTime());

            $this->mm->create($message);

            $messageList = $this->mm->findByChannel(intval($_POST["chan-id"]));
            $messages = [];

            foreach($messageList as $item)
            {
                $message = $item->toArray();
                $messages[] = $message;
            }

            if(count($messages) > 0)
            {
                $this->renderJson(["status" => "OK", "messages" => $messages, "channel" => $messageList[0]->getChannel()->toArray()]);
            }
            else
            {
                $this->renderJson(["status" => "OK", "messages" => $messages, "channel" => $this->chanM->findOne(intval($_POST["chan-id"]))->toArray()]);
            }
        }
        else
        {
            $errors = [];

            if(!isset($_POST["chan-id"]))
            {
                $errors[] = "Missing channel id";
            }

            if(!isset($_POST["message"]))
            {
                $errors[] = "Missing message";
            }

            $this->renderJson(["status" => "NOK", "errors" => $errors]);
        }
    }
}