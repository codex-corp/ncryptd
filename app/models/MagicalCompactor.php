<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

/**
 * MagicalCompactor.php -- Main class
 * (c) 2010 Jurriaan Pruis (email@jurriaanpruis.nl)
 **/

class MagicalCompactor
{

    public static $safechar = array('?', '!', ';', ':', '}', '{', '(', ')', ',', '=', '|', '&', '>', '<', '.', '-', '+', '*', '%', '/');
    public static $semisafe = array('"', '\'');
    public static $removable = array(); //array(T_COMMENT, T_COMMENT, T_DOC_COMMENT, T_OPEN_TAG, T_CLOSE_TAG);
    public static $requires = array(); //array(T_REQUIRE_ONCE,T_INCLUDE_ONCE); // use require_once and include_once for including of static files
    public static $aftertoken = array(T_BOOLEAN_OR, T_BOOLEAN_AND, T_IS_EQUAL, T_IS_GREATER_OR_EQUAL,
                                      T_IS_IDENTICAL, T_IS_NOT_EQUAL, T_IS_NOT_IDENTICAL, T_IS_SMALLER_OR_EQUAL,
                                      T_PLUS_EQUAL, T_MINUS_EQUAL, T_OR_EQUAL, T_DEC, T_DOUBLE_ARROW,
                                      T_ENCAPSED_AND_WHITESPACE, T_CURLY_OPEN, T_INC, T_IF, T_CONCAT_EQUAL, T_WHITESPACE);
    public static $beforetoken = array(T_BOOLEAN_OR, T_BOOLEAN_AND, T_IS_EQUAL, T_IS_GREATER_OR_EQUAL,
                                       T_IS_IDENTICAL, T_IS_NOT_EQUAL, T_IS_NOT_IDENTICAL, T_IS_SMALLER_OR_EQUAL,
                                       T_PLUS_EQUAL, T_MINUS_EQUAL, T_OR_EQUAL, T_DEC, T_DOUBLE_ARROW,
                                       T_ENCAPSED_AND_WHITESPACE, T_CURLY_OPEN, T_INC, T_IF, T_CONCAT_EQUAL, T_WHITESPACE,
                                       T_VARIABLE, T_CONSTANT_ENCAPSED_STRING);
    public static $keyword = array(T_ECHO, T_PRINT, T_CASE);
    /** The files excluded during a {@link compactAll()}. */
    protected $excludes = array();
    private $compacted = array();
    private $handle;
    private $basepath, $filter = null;

    /**
     * Creates a new MagicalCompactor object.
     *
     * @param string $output
     *  The file to which the compressed output is written
     */
    public function __construct()
    {

    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * Compacts a single file.
     *
     * @param string $file
     *  The file to compact.
     */
    public function compact($file)
    {
        $compact = new CompactFile($file, $this->handle, $this->filter);
        $compact->compact();
        return $compact->display();
    }

}


class CompactFile
{
    private $out, $filterfunc;
    public $filesize, $compressedsize, $filename, $contents;

    /**
     * Creates CompactFile object
     *
     * @param string $filename
     *  The input file.
     * @param resource $out
     *  The output filepointer to which the compressed data is appended.
     */
    public function __construct($filename, $out, $filterfunc = null)
    {
        $this->out = $out;
        $this->filename = $filename;
        if ($filterfunc == null) {
            $filterfunc = function ($in) {
                return $in;
            };
        }
        $this->filterfunc = $filterfunc;
    }

    /**
     * Compacts $filename.
     */
    public function compact()
    {
        $tokens = $this->getTokens();
        $removenext = false; // Remove next whitespace
        //$start = ftell($this->out); // Position in output
        $len = count($tokens);
        for ($i = 0; $len > $i; $i++) {
            $token = $tokens[$i];
            $nexttoken = ($i + 1 < $len) ? $tokens[$i + 1] : '';
            $prevtoken = ($i - 1 > -1) ? $tokens[$i - 1] : '';

            if (is_string($token)) {
                if (in_array($token, MagicalCompactor::$safechar)) $removenext = true;
                $this->write($token);
            } else if ($token[0] == T_WHITESPACE) {
                if (!$removenext) {
                    if (is_string($nexttoken)) {
                        if (!in_array($nexttoken, MagicalCompactor::$safechar) && !(in_array($nexttoken, MagicalCompactor::$semisafe) && in_array($prevtoken[0], MagicalCompactor::$keyword))) {
                            $this->write(' ');
                        }
                    } else if (!in_array($nexttoken[0], MagicalCompactor::$beforetoken)) {
                        $this->write(' ');
                    }
                }
            } else if (in_array($token[0], MagicalCompactor::$aftertoken)) {
                $removenext = true;
                $this->write($token[1]);
            } else if (in_array($token[0], MagicalCompactor::$removable)) {
                $removenext = true;
            } else if (in_array($token[0], MagicalCompactor::$requires)) { // Remove require + everything until ';', maybe not safe?
                for ($i2 = $i; $len > $i2; $i2++) {
                    $rtoken = &$tokens[$i2];
                    if ($rtoken == ';') {
                        $rtoken = '';
                        break;
                    } else {
                        $rtoken = '';
                    }
                }
            } else {
                $removenext = false;
                $this->write($token[1]);
            }
        }
        //$this->compressedsize = ftell($this->out) - $start;
    }

    private function write($string)
    {
        $this->contents .= $string;
    }

    function display()
    {
        return $this->contents;
    }

    private function getTokens()
    {
        $func = $this->filterfunc;
        return token_get_all($func(trim($this->filename)));
    }
}