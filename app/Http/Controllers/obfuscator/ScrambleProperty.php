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
use Controllers\Obfuscator\StringScrambler;

use PhpParser\Node;

use PhpParser\Node\Stmt\Class_ as ClassNode;
use PhpParser\Node\Stmt\Property;

use PhpParser\Node\Expr\PropertyFetch;

use PhpParser\Node\Expr\StaticPropertyFetch;

use PhpParser\Node\Expr\Variable;

class ScrambleProperty extends ScramblerVisitor
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
        $scrambler = new StringScrambler();
        parent::__construct($scrambler);

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
        if ($node instanceof PropertyFetch OR $node instanceof StaticPropertyFetch) {

            if (!is_string($node->name)) {
                return;
            }

            if ($this->isRenamed($node->name)) {
                $node->name = $this->getNewName($node->name);
                return $node;
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
            if ($node instanceof Property) {

                if( !$node->isPublic() && !$node->isProtected() && !$node->isPrivate() ) return;

                foreach($node->props as $property) {
                    // Record original name and scramble it
                    $originalName = $property->name;
                    $this->scramble($property);

                    // Record renaming
                    $this->renamed($originalName, $property->name);

                    $this->setVarPack(array_diff($this->getRenamed(), $this->getMagcial()->UdExcVarArray));
                }
            }

            // Recurse over child nodes
            if (isset($node->stmts) && is_array($node->stmts)) {
                $this->scanPropertyDefinitions($node->stmts);
            }
        }
    }
}
