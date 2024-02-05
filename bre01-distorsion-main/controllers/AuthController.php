<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    private CategoryManager $catM;
    private ChannelManager $chanM;
    private UserManager $um;

    private MediaManager $mm;

    public function __construct()
    {
        $this->chanM = new ChannelManager();
        $this->catM = new CategoryManager();
        $this->um = new UserManager();
        $this->mm = new MediaManager();
    }

    public function register()
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

        $this->render("register", [
            "categories" => $list
        ]);
    }

    public function checkRegister()
    {
        if(isset($_POST["username"]) && isset($_POST["password"]))
        {
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $user = $this->um->findByUsername($_POST["username"]);

            if($user === null)
            {
                if(isset($_FILES)){
                    $uploader = new Uploader();
                    $media = $uploader->upload($_FILES, "image");
                    $this->mm->create($media);
                    $user = new User($_POST["username"], $password, "USER", $media);
                }
                else
                {
                    $user = new User($_POST["username"], $password, "USER");
                }

                $this->um->create($user);

                $_SESSION["user"] = $user->getId();

                $this->redirect("index.php");
            }
            else
            {
                $this->redirect("index.php?route=register");
            }
        }
        else
        {
            $this->redirect("index.php?route=register");
        }
    }

    public function login()
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

        $this->render("login", [
            "categories" => $list
        ]);
    }

    public function checkLogin()
    {
        if(isset($_POST["username"]) && isset($_POST["password"]))
        {
            $user = $this->um->findByUsername($_POST["username"]);

            if($user !== null)
            {
                if(password_verify($_POST["password"], $user->getPassword()))
                {
                    $_SESSION["user"] = $user->getId();

                    $this->redirect("index.php");
                }
                else
                {
                    $this->redirect("index.php?route=login");
                }
            }
            else
            {
                $this->redirect("index.php?route=login");
            }
        }
        else
        {
            $this->redirect("index.php?route=login");
        }

        $this->redirect("index.php");
    }

    public function logout()
    {
        session_destroy();
        $this->redirect("index.php");
    }
}