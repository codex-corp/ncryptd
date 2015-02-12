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
 * Skipping certain classes trait
 *
 * @category        Naneau
 * @package         Obfuscator
 * @subpackage      NodeVisitor
 */
trait SkipTrait
{
    /**
     * Skip processing?
     *
     * @var bool
     **/
    private $skip = false;

    /**
     * Should we skip processing?
     *
     * @param  bool                  $skip
     * @return ScramblePrivateMethod
     **/
    protected function skip($skip = false)
    {
        $this->skip = $skip;

        return $this;
    }

    /**
     * Should we skip processing?
     *
     * @return bool
     **/
    protected function shouldSkip()
    {
        return $this->skip;
    }
}
