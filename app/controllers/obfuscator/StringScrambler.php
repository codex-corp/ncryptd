<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

class StringScrambler
{
    /**
     * Salt
     *
     * @return void
     **/
    private $salt;

    /**
     * Constructor
     *
     * @param  string $salt optional salt, when left empty (null) semi-random value will be generated
     * @return void
     **/
    public function __construct($salt = null)
    {
        if ($salt === null) {
            $this->setSalt(
                md5(microtime(true) . rand(0,1))
            );
        }
    }

    /**
     * Scramble a string
     *
     * @param  string $string
     * @return string
     **/
    public function scramble($obj, $type)
    {
        switch($type){
            case "class":
                $obj = "C" . substr(md5($obj . self::getSalt()), 0, 8);
                break;

            case "function":
                $obj = "F".substr(md5($obj . self::getSalt()), 0,8);
                break;

            case "var":
                $obj =  'V' . substr(md5(uniqid($obj, true)) . self::getSalt(), 0, mt_rand(5, 12));
                break;
        }

        return $obj;
    }

    /**
     * Get the salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set the salt
     *
     * @param  string          $salt
     * @return StringScrambler
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}