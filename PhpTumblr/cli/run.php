<?php
/**
 * Created by PhpStorm.
 * User: thrynillan
 * Date: 1/16/16
 * Time: 5:36 PM
 */

require_once '../Model/NetSocket.php';
require_once '../Model/NetHttp.php';
require_once '../Model/ReadTumblr.php';
require_once '../Model/Post.php';

$start  = 0;
$number = 5;
$posts  = new PhpTumblr_Model_Post();
$return = $posts
    ->getPosts($start, $number)
    ->formatPosts()
    ->toJson();
file_put_contents('../../public/data.json', $return);