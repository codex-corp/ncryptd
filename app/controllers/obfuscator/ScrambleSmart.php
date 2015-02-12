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

use PhpParser\Node\Expr\Variable;

class ScrambleSmart extends ScramblerVisitor
{
    use SkipTrait;
    use ReportArraysTrait;

    var $_classes;

    public function __construct()
    {
        $scrambler = new StringScrambler();
        parent::__construct($scrambler);
        $this->_classes = array();
    }

    public function beforeTraverse(array $nodes)
    {

        $this->scanForFunctions($nodes);

        return $nodes;
    }

    public function enterNode(Node $node)
    {

        if ($node instanceof Node\Expr\Assign
            && $node->var instanceof Node\Expr\Variable
            && $node->expr instanceof Node\Expr\New_
        ) {

            if (is_string($node->var->name)) {
                $classObject = $node->var->name;
                //array_push($this->_classes, $classObject);
            }

            if ($node->expr->getIterator()->key() === 'class') {
                $className = $node->expr->class->toString();
            }
            //echo $classObject . '->' . $className;
        }
    }

    public function leaveNode(Node $node){

        if ($node instanceof Node\Stmt\ClassMethod) {

            if (isset($node->stmts) && is_array($node->stmts)) {

                foreach($node->stmts as $stmt){

                    if($stmt instanceof Node\Expr\MethodCall && $stmt->var instanceof Variable){
                        //echo '<pre>';

                        if( isset($stmt->var->name) && isset($stmt->name) ){
                            if(in_array($stmt->var->name, $this->_classes)){
                                //echo $stmt->name;
                            }
                        }
                    }
                }
            }
        }
    }

    function scanForFunctions($nodes){

        foreach ($nodes as $node) {

            if($node instanceof Node\Expr\MethodCall && $node->var instanceof Variable){
                /**
                 * $node->name {function node}
                 * $node->var->name class new object {$object = new Class}
                 */
                if( isset($node->var->name) && isset($node->name) ){
                    if(array_key_exists($node->name, $this->getFuncPack())){
                        //Replace the function node which already has obfuscated
                        $node->name = $this->getFuncPack()[$node->name];
                    }
                }
            }

            // Recourse over child nodes
            if (isset($node->stmts) && is_array($node->stmts)) {
                $this->scanForFunctions($node->stmts);
            }
        }

    }

}
