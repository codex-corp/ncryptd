<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

use Controllers\Obfuscator\TrackingRenamerTrait;
use Controllers\Obfuscator\SkipTrait;

use Controllers\Obfuscator\Scrambler as ScramblerVisitor;

use PhpParser\Node;

use PhpParser\Node\Stmt\Class_ as ClassNode;
use PhpParser\Node\Stmt\ClassMethod;

use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;

use PhpParser\NodeVisitor;

use MagicalHelpers;
use Illuminate\Support\Facades\Session;

class ScrambleFunction extends ScramblerVisitor
{
    use TrackingRenamerTrait;
    use SkipTrait;
    use ReportArraysTrait;

    /**
     * Constructor
     *
     * @param  StringScrambler $scrambler
     * @return void
     **/
    public function __construct(&$magical)
    {
        parent::__construct();

        $this->setMagcial($magical);
    }

    /**
     * Before node traversal
     *
     * @param  Node[] $nodes
     * @return array
     **/
    public function beforeTraverse(array $nodes)
    {
        $this
            ->resetRenamed()
            ->skip($this->variableMethodCallsUsed($nodes));

        $this->scanMethodDefinitions($nodes);

        return $nodes;
    }

    /**
     * Check all variable nodes
     *
     * @param  Node $node
     * @return void
     **/
    public function enterNode(Node $node)
    {
        if ($this->shouldSkip()) {
            return;
        }

        // Scramble calls
        /**
         *: Expr_MethodCall(
                var: Expr_Variable(
                name: this
                )
                name: getInstance
                args: array(
                )
            )
         */
        if ($node instanceof MethodCall) {

            // Node wasn't renamed
            if (!$this->isRenamed($node->name)) {
                return;
            }

            // Scramble usage
            return $this->scramble($node, 'name', 'function');
        }
    }

    /**
     * Recursively scan for method calls and see if function are used
     *
     * @param  Node[] $nodes
     * @return void
     **/
    private function variableMethodCallsUsed(array $nodes)
    {
        foreach ($nodes as $node) {
            //if ($node instanceof MethodCall && $node->name instanceof Variable) {
            if ($node instanceof MethodCall && $node->name instanceof Variable) {
                // A method call uses a Variable as its name
                return true;
            }

            // Recurse over child nodes
            if (isset($node->stmts) && is_array($node->stmts)) {
                $used = $this->variableMethodCallsUsed($node->stmts);

                if ($used) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Recursively scan for function method definitions and rename them
     *
     * @param  Node[] $nodes
     * @return void
     **/
    private function scanMethodDefinitions(array $nodes)
    {
        foreach ($nodes as $node) {
            // Scramble the private method definitions
            if ($node instanceof ClassMethod) {

                // function name
                //echo $node->name;

                // function method
                //echo $node->isPublic();

                // Record original name and scramble it
                $originalName = $node->name;
                $this->scramble($node, 'name', 'function');

                // Record renaming
                $this->renamed($originalName, $node->name);

                $this->setFuncPack(array_diff($this->getRenamed(), $this->getMagcial()->UdExcFuncArray));
            }

            // Recurse over child nodes
            if (isset($node->stmts) && is_array($node->stmts)) {
                $this->scanMethodDefinitions($node->stmts);
            }
        }
    }
}