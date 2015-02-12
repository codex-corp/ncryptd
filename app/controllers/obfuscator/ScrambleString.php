<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

use Controllers\Obfuscator\Scrambler as ScramblerVisitor;
use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Name;

/**
 * TODO: fix (static $var) method
 */
class ScrambleString extends ScramblerVisitor{

    public function __construct(&$magical)
    {

        $this->setMagcial($magical);
    }

    public function getStrEqv($str)
    {
        //$str = str_replace("\'", "'", $str);
        $l = strlen($str)-1; $eqv = array();
        for ($i = 1; $i < $l; $i++)
            $eqv[] = "chr(" . ord($str[$i]) . ")";
        if (!count($eqv)) return $str;
        return implode('.', $eqv);
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Scalar\Encapsed) {

            $node->name = $this->getStrEqv($node->name);
        }
    }

}