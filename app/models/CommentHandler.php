<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class CommentHandler extends Eloquent
{
    var $comments = array();
    var $keep_first = 0;
    var $found = 0;
    var $replaced = 0;

    //-------------------------------------------
    // public
    //-------------------------------------------

    //initialise class, tell it how many comments
    //you wish to preserve
    function CommentHandler($keep_first)
    {
        $this->keep_first = $keep_first;
    }

    //tell it how many comments
    //you wish to preserve
    function SetKeepFirst($keep_first)
    {
        $this->keep_first = $keep_first;
    }

    //remove comments from string, replacing the first
    //n comments with placeholders
    function RemoveComments(&$contents)
    {
        $StdReplaceComments = array('/**/', '//', '#');

        $this->comments = array();
        $this->found = 0;
        $this->replaced = 0;

        //because we use multiple regexps to spot the comments
        //we can't be sure which ones come first, so we replace
        //each comment with a placeholder. During the
        //RestoreComments phase, we *can* know which comments are
        //first, and can decide whether or not to restore the original

        if (in_array('//', $StdReplaceComments)) {
            // REMOVE COMMENTS //, EXCEPT '//-->'
            $contents = preg_replace("/[ \t\n]+(\/\/)(?![ \t]*-->)[^\n]*/me",
                //		    $contents = preg_replace( "/(\/\/)(?![ \t]*-->)[^\n]*/me",
                "\$this->StoreComment('\\0')", $contents);
        }


        if (in_array('#', $StdReplaceComments)) {
            // REMOVE COMMENTS #
            $contents = preg_replace("/[ \t\n]+(\#)[^\n]*/sme", "\$this->StoreComment('\\0')", $contents);
        }

        // REMOVE COMMENTS /* ... */
        if (in_array('/**/', $StdReplaceComments)) {
            $contents = preg_replace('/\/\*.*?\*\/[ \n]*/sme', "\$this->StoreComment('\\0')", $contents);
        }
    }

    //restore the first n comments
    function RestoreComments(&$contents)
    {
        $contents = preg_replace('/___HANY_COMMENT_(\d+)/e', "\$this->FetchComment('\\1')", $contents);

    }

    //-------------------------------------------
    // private
    //-------------------------------------------

    function StoreComment($comment)
    {
        //store the comment and return a placeholder
        //this allows us to preserve the format of
        //comments when HANY removes white space
        $this->comments[$this->found] = $comment;

        $replacement = '';

        if (($pos = strpos($comment, '?>')) !== false && strpos($comment, '<?') === false) {
            $comment = substr($comment, 0, $pos);
            $replacement = '?>';
        }
        // it it is // type of comment, change it to /* */ type
        if ($comment[0] == '/' && $comment[1] == '/') {
            $comment[1] = '*';
            $comment .= '*/ ';
        }

        $this->comments[$this->found] = $comment;
        $replacement = "___HANY_COMMENT_" . $this->found . " " . $replacement;

        $this->found++;

        return $replacement;
    }

    function FetchComment($idx)
    {
        if ($this->replaced < $this->keep_first) {
            $this->replaced++;
            return $this->comments[$idx];
        }
        return "";
    }
}
