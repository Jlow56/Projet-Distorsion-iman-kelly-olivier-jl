<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

require "models/Category.php";
require "models/Channel.php";
require "models/User.php";
require "models/Message.php";
require "models/Media.php";
require "services/RandomStringGenerator.php";
require "services/Uploader.php";
require "managers/AbstractManager.php";
require "managers/MediaManager.php";
require "managers/CategoryManager.php";
require "managers/ChannelManager.php";
require "managers/MessageManager.php";
require "managers/UserManager.php";
require "controllers/AbstractController.php";
require "controllers/AuthController.php";
require "controllers/ChatController.php";
require "controllers/DefaultController.php";
require "config/Router.php";

