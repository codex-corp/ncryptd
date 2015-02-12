<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

use PhpParser\Lexer;
use PhpParser\Parser;
use PhpParser\PrettyPrinter\Standard as PrettyPrinter;

/**
 * Obfuscator
 *
 * Obfuscates a directory of files
 *
 * @package         Obfuscator
 * @subpackage      Obfuscator
 */
class Obfuscator extends MagicalController
{

    use \Controllers\Obfuscator\ReportArraysTrait;

    public function obfuscate($directory, $stripWhitespace = false)
    {
        foreach ($this->getFiles($directory) as $file) {

            $source = file_get_contents($file);
            // Write obfuscated source
            $this->obfuscateFileContents($source);
        }

        $this->resetAllPack();
        $this->resetExcluded();
    }

    private function getFiles($directory)
    {
        return new RegexIterator(
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory)
            ),
            '/\.php$/'
        );
    }

    /**
     * Obfuscate a single file's contents
     *
     * @param  string $source
     * @return string obfuscated contents
     **/
    public function obfuscateFileContents($source, $file = false)
    {

        $traverser = new PhpParser\NodeTraverser;

        if (input::get('ReplaceVariables')) {
            /**
             * all $vars
             */
            $traverser->addVisitor(new \Controllers\Obfuscator\ScrambleVariable($this));

            $traverser->addVisitor(new \Controllers\Obfuscator\ScrambleString($this));
        }

        if (input::get('ReplaceFunctions')) {
            /**
             * all OOP functions
             */
            $traverser->addVisitor(new \Controllers\Obfuscator\ScrambleFunction($this));

            /**
             * all NONE OOP functions (NATIVE)
             */
            $traverser->addVisitor(new \Controllers\Obfuscator\ScrambleNativeFunction($this));
        }

        if (input::get('ReplaceVariables')) {
            /**
             * all OOP $this->vars
             */
            $traverser->addVisitor(new \Controllers\Obfuscator\ScrambleProperty($this));
        }

        //if( input::get('ReplaceSmart') ) {
        //$traverser->addVisitor(new \Controllers\Obfuscator\ScrambleSmart($this));
        //}

        $parser = new Parser(new Lexer);

        // traverse
        $stmts = $traverser->traverse($parser->parse($source));

        $prettyPrinter = new PrettyPrinter;

        $nodeDumper = new PhpParser\NodeDumper;

        Debugbar::debug($stmts);

        // pretty print
        $code = "<?php\n" . $prettyPrinter->prettyPrint($stmts);

        if (Input::has('test')) {
            @header("Content-Type:text/plain");
            print_r($this->getFuncPack());
            print_r($this->getVarPack());
            echo '<pre>';
            echo $nodeDumper->dump($stmts), "\n";
            echo htmlentities($code);
            echo '</pre>';
        }
        return $code;
    }
}
