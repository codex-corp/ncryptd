<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

use Controllers\Obfuscator\StringScrambler;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node;

use \InvalidArgumentException;

abstract class Scrambler extends NodeVisitorAbstract
{
    use \MagicalTrait {
        \MagicalTrait::__construct as private __MagicConstruct;
    }

    /**
     * The string scrambler
     *
     * @var StringScrambler
     **/
    private $scrambler;

    /**
     * Variables to ignore
     *
     * @var string[]
     **/
    private $ignore = array();

    /**
     * Constructor
     *
     * @param  StringScrambler $scrambler
     * @return void
     **/
    public function __construct()
    {
        $scrambler = new StringScrambler();
        $this->setScrambler($scrambler);
        $this->__MagicConstruct();
    }

    /**
     * Scramble a property of a node
     *
     * @param  Node   $node
     * @param  string $var  property to scramble
     * @return Node
     **/
    protected function scramble(Node $node, $var = 'name', $type = 'var', $prename = false)
    {
        // String/value to scramble
        $toScramble = $node->$var;

        // Make sure there's something to scramble
        if (strlen($toScramble) === 0) {
            throw new InvalidArgumentException(sprintf(
                '"%s" value empty for node, can not scramble',
                $var
            ));
        }

        $this->fetchExcluded($this->getFileInProcess());

        // Should we ignore it?
        if (in_array($toScramble, $this->getIgnore())) {
            return $node;
        }

        // Should we ignore those vars?
        if (isset($this->UdExcVarArray)
            AND
            ( in_array($toScramble, $this->UdExcVarArray) OR in_array($toScramble, $this->StdExcVarArray) )
            AND
            $type == 'var') {
            return $node;
        }

        // Should we ignore those functions?
        if (isset($this->UdExcFuncArray)
            AND
            ( in_array($toScramble, $this->UdExcFuncArray) OR in_array($toScramble, $this->StdExcFuncArray) )
            AND
            $type == 'function') {
            return $node;
        }

        $node->$var = $this->scrambleIt($toScramble,$type);

        // Return the node
        return $node;
    }

    /**
     * Scramble a string
     *
     * @param  string $string
     * @return string
     **/
    protected function scrambleIt($string,$type)
    {
        return $this->getScrambler()->scramble($string,$type);
    }

    /**
     * Get the string scrambler
     *
     * @return StringScrambler
     */
    public function getScrambler()
    {
        return $this->scrambler;
    }

    /**
     * Set the string scrambler
     *
     * @param  StringScrambler $scrambler
     * @return RenameParameter
     */
    public function setScrambler(StringScrambler $scrambler)
    {
        $this->scrambler = $scrambler;

        return $this;
    }

    /**
     * Get variables to ignore
     *
     * @return string[]
     */
    public function getIgnore()
    {
        return $this->ignore;
    }

    /**
     * Set variables to ignore
     *
     * @param  string[] $ignore
     * @return parent
     */
    public function setIgnore(array $ignore)
    {
        $this->ignore = $ignore;

        return $this;
    }

    /**
     * Add a variable name to ignore
     *
     * @param  string|string[]        $ignore
     * @return RenameParameterVisitor
     **/
    public function addIgnore($ignore)
    {
        if (is_string($ignore)) {
            $this->ignore = array_merge($this->ignore, array($ignore));
        } else if (is_array($ignore)) {
            $this->ignore = array_merge($this->ignore, $ignore);
        } else {
            throw new InvalidArgumentException('Invalid ignore type passed');
        }
        return $this;
    }

    /**
     * @param \MagicalController $scrambler
     * @return $this
     */
    public function setMagcial(\MagicalController $scrambler){

        $this->magcial = $scrambler;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMagcial(){

        return $this->magcial;
    }
}
