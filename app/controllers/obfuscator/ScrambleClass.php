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

use PhpParser\Node\Stmt\Class_ as ClassNode;

/**
 * ScrambleClass
 * Renames functions properties
 */
class ScrambleClass extends ScramblerVisitor
{
    use TrackingRenamerTrait;
    use SkipTrait;

    /**
     * Constructor
     **/
    public function __construct()
    {
        $scrambler = new StringScrambler();
        parent::__construct($scrambler);
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
            ->scanPropertyDefinitions($nodes);

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
        if ($node instanceof ClassNode) {

            if ($this->isRenamed($node->name)) {
                $node->name = $this->getNewName($node->name);
            }
        }
    }

    /**
     * Recursively scan for private method definitions and rename them
     *
     * @param  Node[] $nodes
     * @return void
     **/
    private function scanPropertyDefinitions(array $nodes)
    {
        foreach ($nodes as $node) {
            // Scramble the private method definitions
            if ($node instanceof ClassNode) {
                    // Record original name and scramble it
                    $originalName = $node->name;
                    $this->scramble($node);
                    // Record renaming
                    $this->renamed($originalName, $node->name);
            }

            // Recurse over child nodes
            if (isset($node->stmts) && is_array($node->stmts)) {
                $this->scanPropertyDefinitions($node->stmts);
            }
        }
    }
}
