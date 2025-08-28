<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

/**
 * SkipTrait
 *
 * Renaming trait, for renaming things that require tracking
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */
trait TrackingRenamerTrait
{
    /**
     * Renamed variables
     *
     * @var string[]
     **/
    private $renamed = array();

    protected function getRenamed()
    {
        return $this->renamed;
    }

    /**
     * Record renaming of method
     *
     * @param  string    $method
     * @param  string    $newName
     * @return SkipTrait
     **/
    protected function renamed($method, $newName)
    {
        $this->renamed[$method] = $newName;

        return $this;
    }

    /**
     * Has a method been renamed?
     *
     * @param  string $method
     * @return bool
     **/
    protected function isRenamed($method)
    {
        if (empty($method)) {
            return false;
        }

        return isset($this->renamed[$method]);
    }

    /**
     * Get new name of a method
     *
     * @param  string $method
     * @return string
     **/
    protected function getNewName($method)
    {
        if (!$this->isRenamed($method)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" was not renamed',
                $method
            ));
        }

        return $this->renamed[$method];
    }

    /**
     * Reset renamed list
     *
     * @return SkipTrait
     **/
    protected function resetRenamed()
    {
        $this->renamed = array();

        return $this;
    }
}
