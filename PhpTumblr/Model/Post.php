<?php
/**
 * Created by PhpStorm.
 * User: thrynillan
 * Date: 6/10/15
 * Time: 1:28 PM
 */
class PhpTumblr_Model_Post
{
    /**
     * @var
     */
    protected $_post;

    /**
     * @var
     */
    protected $_stats;

    /**
     * @var
     */
    protected $tumblr;

    /**
     * @param int $nStart
     * @param int $mNum
     * @param null $sType
     * @param null $nID
     * @param null $sTagged
     * @param null $sSearch
     * @return $this
     */
    public function getPosts($nStart = 0,$mNum = 20,$sType = null,$nID = null,$sTagged = null, $sSearch = null)
    {
        try {
            $tumblr = new PhpTumblr_Model_ReadTumblr('xxxgiannamichaels');
            $tumblr->getPosts($nStart, $mNum, $sType, $nID, $sTagged, $sSearch);
        } catch (Zend_Exception $e) {
            echo "Caught exception: " . get_class($e) . "\n";
            echo "Message: " . $e->getMessage() . "\n";
            die();
        }
        $dump = $tumblr->dumpArray();
        $this->_post = $dump['posts'];

        return $this;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function formatPosts()
    {
        $return = array();
        if (empty($this->_post)) {
            throw new Exception('post not set!');
        }
        foreach ($this->_post as $post) {
            if (isset($post['content']['photos'])) {
                $photos = $post['content']['photos'];
                $return = $return +  $this->_formatFotos($photos, $post);
            } else {
                $return[] = $post;
            }
        }

        $this->_post = $return;
        return $this;
    }

    /**
     * @param $photos
     * @param $post
     * @return array
     */
    public function _formatFotos($photos, $post)
    {
        $return = array();
        foreach($photos as $photo) {
          $return[] = array(
            'id'      => $post['id'],
            'url'     => $post['url'],
            'type'    => $post['type'],
            'caption' => $post['caption'],
            'content' => $photo
          );
        }
        return $return;
    }

    public function toJson() {
        $return = json_encode($this->_post);
        return $return;
    }

    public function next()
    {
        return next($this->_post);
    }
}