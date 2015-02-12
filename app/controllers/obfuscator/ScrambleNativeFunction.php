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

use PhpParser\Node\Stmt\Function_ as FuncNode;

use PhpParser\NodeVisitor;

use MagicalHelpers;
use Illuminate\Support\Facades\Session;

class ScrambleNativeFunction extends ScramblerVisitor
{
    use TrackingRenamerTrait;
    use SkipTrait;
    use ReportArraysTrait;

    public function __construct(&$magical)
    {
        parent::__construct();

        if(Session::has('excluded') && is_array(Session::get('excluded'))) {
            /*
             * Excluded
             * [{"FileID":"dbconnector.php","classes":false,"vars":false,"functions":"getInstance"}]
             * fixme: get filename
             */
            //$magical->UdExcFuncArray = MagicalHelpers::find_position(Session::get('excluded'), "dbconnector.php", 'functions');
        }

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
        if ($node instanceof Node\Expr\FuncCall) {
            // Node wasn't renamed
            $originalName = (string) $node->name;

            if (is_string($originalName) && array_key_exists("$originalName", $this->getRenamed()))
                $node->name = new Node\Name($this->getRenamed()[$originalName]);
        }
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
            if ($node instanceof FuncNode) {

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