<?php
/**
 * Created by PhpStorm.
 * User: thrynillan
 * Date: 6/10/15
 * Time: 1:28 PM
 */
class PhpTumblr_Model_Post
{
    protected $_post;

    protected $_stats;

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
        $dump =  $tumblr->dumpArray();
        $this->_post = $dump['posts'];

        return $this;
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