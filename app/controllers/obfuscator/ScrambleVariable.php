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
use PhpParser\Node\Expr\ClosureUse;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Catch_ as CatchStatement;

class ScrambleVariable extends ScramblerVisitor
{
    use TrackingRenamerTrait;
    use ReportArraysTrait;

    /**
     * Constructor
     *
     * @param  StringScrambler $scrambler
     * @return void
     **/
    public function __construct(&$magical)
    {
        $scrambler = new StringScrambler();
        parent::__construct($scrambler);

        $this->setMagcial($magical);
    }

    /**
     * Check all variable nodes
     *
     * @param  Node $node
     * @return void
     **/
    public function enterNode(Node $node)
    {
        // Function param or variable use
        if ($node instanceof Param || $node instanceof Variable) {

            if (!is_string($node->name)) {
                return;
            }

            if ($this->isRenamed($node->name)) {
                $node->name = $this->getNewName($node->name);
                return $node;
            }
        }

        // try {} catch () {}
        if ($node instanceof CatchStatement) {

            return $this->scramble($node, 'var');
        }

        // Function() use ($x, $y) {}
        if ($node instanceof ClosureUse) {
            return $this->scramble($node, 'var');
        }
    }

    public function leaveNode(Node $node)
    {
        if ($node instanceof Param || $node instanceof Variable) {

            $originalName = $node->name;

            if (!in_array($originalName, $this->getRenamed())) {
                $this->scramble($node);

                $this->renamed($originalName, $node->name);

                $this->setVarPack(array_diff($this->getRenamed(), $this->getMagcial()->StdExcVarArray));
            }
        }
    }
}
