<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

use \Illuminate\Support\Facades\Input;

class MagicalFetch extends MagicalController
{

    use \Controllers\Obfuscator\ReportArraysTrait;

    function __construct(){
        parent::__construct();
    }

    /**
     * PHP Internal functions
     * @string $int_functions is buildin function to get all php core functions
     * @global $this->_classes included all classes in files
     * @global $this->_fullclasses is @array included each class and all functions related to it
     * @global $this->FuncArray is @array included all functions and class if requested
     * @global $this->ConstArray is @array included all constants definded in file
     * @global $this->VarArray is @array included all vars definded in file
     * @return void
     */
    function PHPFetchContent($contents,$analyze=false,$file=false){

        //$contents = file_get_contents('dbconnector.php');

        $tokens = new TokenStream($contents);

        $int_functions = get_defined_functions();

        $this->fetchExcluded($file);

        $i = 0;

        //echo '<pre>';
        //print_r($tokens->debugDump());
        //echo '</pre>';

        while ($i = $tokens->skipWhitespace($i)) {

            if($tokens[$i]->is(T_CLASS)) {

                //extract class and assign it to class object
                $this->class = $tokens[$i + 2]->content;

                if(input::get('ReplaceClasses')){

                    //extract class and assign it to class object
                    $this->class = $tokens[$i + 2]->content;

                    if(!in_array($this->class, $this->_classes)){
                        $this->_classes[] = $this->class;
                    }

                    //obfuscate the class object with prefix "C"
                    $class_obfuc = "C".substr(md5($this->class), 0,8);

                    //generate classes and encoded
                    if(!in_array($this->class, $this->ClassArray)){
                        //if process is not practical analyze, obfuscate it
                        //if(!$analyze)
                        $this->ClassArray[$this->class] = $class_obfuc;
                    }

                    //generate class name and replace it
                    $tokens[$i + 2]->content = $class_obfuc;
                }

                //if(!isset($this->_fullclasses['classes']))
                //    $this->_fullclasses['classes']['NONE_OOP'] = 'on';
            }
            /**
             * Find all objects before the first function in the file
             * public , private and protected: vars
             */
            elseif($tokens->findEOS($i, false) && $tokens[$i]->is(T_PUBLIC, T_PRIVATE, T_PROTECTED,T_VAR,T_STATIC)){
                /**
                 *  check if after the T_* is not 'static' object
                 *  check if after the T_* is not 'function' object
                 *  private static $_singleton;
                 */
                if(!$tokens[$i+2]->is(T_STATIC) && !$tokens[$i+2]->is(T_FUNCTION)){
                    $defineded_vars = $tokens[$i+2]->content;
                    //so ? assign the existent vars to check it later!
                    if(!in_array($defineded_vars,$this->existent_vars)){
                        $this->existent_vars[substr($tokens[$i+2]->content, 1)] = $defineded_vars;
                    }
                }

                //echo '<pre>';
                //print_r($this->existent_vars);
                //echo '</pre>';
            }
            elseif($tokens[$i]->is(T_NEW)){

                /**
                 * search where class is used and replace it
                 * check if class in our classes
                 * fixme: fix the object it added to class
                 */
                if($tokens[$i+2]->is(T_STRING) and in_array($tokens[$i+2]->content, array_flip($this->ClassArray)) ){

                    $set_in = array_search($tokens[$i+2]->content, $this->_fullclasses['classes']);

                    $tokens[$i + 2]->content = $this->ClassArray[$tokens[$i+2]->content];
                    //if(isset($this->_fullclasses['classes'][$set_in]))
                    //$this->_fullclasses['classes'][$set_in] = $tokens[$i-4]->content;
                }
            }
            /**
             * search for function , name of function will replaced
             */
            elseif($tokens[$i]->is(T_FUNCTION)){

                if( input::get('ReplaceFunctions') ){

                    //extract function and assign it to function object
                    $this->function = $tokens[$i+2]->content;

                    //check if the function not in exclude list
                    if (!in_array($this->function,$this->UdExcFuncArray)){

                        //check if the function object not defined in functions list
                        if(!isset($this->FuncArray[$this->function]))
                            /**
                             * Array ( [MAP_SETTINGS] => F8018a28e [getAutocomplete] => F48b9a789 )
                             * generate function name and push to FuncArray
                             **/
                            $this->FuncArray[$this->function] = "F".substr(md5($this->function), 0,8);
                        // it's Absolutely an function !
                        if($tokens[$i+3]->content == '('){
                            // generate functions tree under the main class
                            if ($this->function and $this->class){
                                //check if the function not defined
                                if(!isset($this->_fullclasses['classes'][$this->class]['functions'][$this->function]))
                                    //assign it to class
                                    $this->_fullclasses['classes'][$this->class]['functions'][$this->function] = $this->function;
                            }
                            //obfuscate the function object with prefix "F"
                            $tokens[$i+2]->content = "F".substr(md5($this->function), 0,8);
                        }
                    }

                    //extends inside functions for  ...
                    //$extends = $tokens->find($i,T_VARIABLE);

                    //Debugbar::info($tokens[$extends+2]->content);

                    /**
                     * extends search if the function is used inside the current function and replace it
                     * @example
                     * $this->function
                     * fixme: need to check if it real function not sample var

                    if($tokens[$extends+2]->is(T_STRING) and in_array($tokens[$extends+2]->content, array_flip($this->FuncArray)) ){
                    ## set the function name
                    $this->function = $tokens[$extends+2]->content;

                    if(isset($this->_fullclasses['classes'][$this->class]['functions'][$this->function])){
                    $tokens[$extends+2]->content = $this->FuncArray[$this->function];
                    }else
                    $tokens[$extends+2]->content = $this->FuncArray[$this->function];
                    }
                     */

                }
            }
            elseif($tokens[$i]->is(T_VARIABLE)){

                if(( input::get('ReplaceVariables') )){
                    //clear $ from var
                    $VarName = substr($tokens[$i]->content, 1);

                    /**
                     * extract the #variable and obfuscate it
                     * Absolutely skip $this object
                     * check again in exclude variables array list
                     * TODO: Check if there duplicated vars and it is an objects
                     * $tokens[$i+1]->type != T_OBJECT_OPERATOR '->'
                     */
                    if ($tokens[$i]->content != '$this' && !(in_array($VarName,$this->UdExcVarArray)))
                    {
                        //check if the var no defineded in variables array list
                        //if process is not practical analyze, obfuscate it
                        if( !isset($this->VarArray[$VarName]) )
                            //obfuscate the variable string with prefix "V"
                            $this->VarArray[$VarName] = 'V'.substr(md5(uniqid($VarName, true)), 0,mt_rand(5, 12));

                        $tokens[$i]->content ="\${$this->VarArray[$VarName]}";


                        //fixme: #exclude the vars in existent_vars from vars
                        $this->_fullclasses['classes'][$this->class]['vars'][$VarName] = $VarName;

                        //$tokens[$i]->content = '${\''.$this->encode_string($this->VarArray[$VarName]).'\'}';
                    }

                    /**
                     * Search for objects and push founded to objects array
                     */
                    if ($tokens[$i]->content != '$this' && $tokens[$i+1]->type == T_OBJECT_OPERATOR){
                        if(!empty($VarName) && !in_array($VarName,$this->ObjectArray))
                            array_push($this->ObjectArray,$VarName);
                    }

                    /**
                     *  search for vars after $this need to replace
                     *  $var or function ?
                     *  $this->object
                     */
                    if($tokens[$i]->content == '$this' && $tokens[$i+1]->type == T_OBJECT_OPERATOR){
                        if($tokens[$i+2]->is(T_STRING)){

                            //check if the string after $this in existent vars array list
                            if(array_key_exists($tokens[$i+2]->content,$this->existent_vars)){
                                //make sure it's not an function have a duplicate var name
                                if($tokens[$i+3]->content != '('){
                                    $this->_fullclasses['classes'][$this->class]['existent_vars'][$tokens[$i+2]->content] = $tokens[$i+2]->content;
                                    //if process is not practical analyze, obfuscate it
                                    //if(!$analyze)
                                    if(!in_array($tokens[$i+2]->content,$this->UdExcVarArray)){
                                        $tokens[$i+2]->content = $this->VarArray[$tokens[$i+2]->content];
                                    }

                                }
                            }
                            //so ? maybe it's a function okay check it
                            if($tokens[$i+3]->content == '(')
                                if(in_array($tokens[$i+2]->content, array_flip($this->FuncArray)))
                                    //hmmm okay fuck it too!
                                    //if process is not practical analyze, obfuscate it
                                    //if(!$analyze)
                                    $tokens[$i+2]->content = $this->FuncArray[$tokens[$i+2]->content];
                        }
                    }
                }
            }
            elseif($tokens[$i]->is(T_CONSTANT_ENCAPSED_STRING)){

                //standard PHP ENV variables that should be replaced

                //if(in_array(substr($tokens[$i-2]->content, 1),$this->StdExcVarArray)){

                //check if the this string start with single quote
                //if (preg_match('/^\'(.*)\'$/', $tokens[$i]->content)) {
                if (preg_match('/\'.*(.*)\'/Uis', $tokens[$i]->content) && input::get('ReplaceEncode')) {
                    $clean_quote = trim($tokens[$i]->content,"'");
                    //endcode it and add double quote
                    $tokens[$i]->content = MagicalHelpers::random_encode("\"$clean_quote\"");
                }
                //}else{
                //if (!preg_match('/^\'(.*)\'$/', $tokens[$i]->content))
                //    $tokens[$i]->content = MagicalHelpers::random_encode($tokens[$i]->content);
                //}

            }
            elseif($tokens[$i]->is(T_STRING)){

                /**
                 * wide check ..
                 * static method CLASS::FUNCTION()
                 * OOP method CLASS->FUNCTION()
                 */
                if($tokens[$i-1]->is(T_DOUBLE_COLON) || $tokens[$i-1]->is(T_OBJECT_OPERATOR)){
                    //check if it's an function
                    if($tokens[$i+1]->content == '('){
                        //search if it definded in functions array list
                        if(in_array($tokens[$i]->content, array_flip($this->FuncArray))){
                            $class = $tokens[$i-2]->content;
                            $function = $tokens[$i]->content;
                            //check if this class exists in class array list
                            if(in_array($class, $this->_fullclasses['classes'])){
                                $found = false;
                                //deep check
                                array_walk_recursive($this->_fullclasses['classes'], function($v, $k) use (&$found)
                                { $found |= ($k == $this->class);});
                                if($found)
                                    ##TODO: add check if class obfuse is required
                                    if(in_array($class,$this->_fullclasses['classes']))
                                        //if process is not practical analyze, obfuscate it
                                        if(isset($this->ClassArray[$class]))
                                            $tokens[$i-2]->content = $this->ClassArray[$class];
                            }

                            if(isset($function,$this->_fullclasses['classes']["$class"])){
                                //check if this function assigned into this class
                                if(in_array($function,$this->_fullclasses['classes']["$class"]['functions']))
                                    //if process is not practical analyze, obfuscate it
                                    //if(!$analyze)
                                    $tokens[$i]->content = $this->FuncArray[$tokens[$i]->content];
                            }
                        }
                    }
                }

                /**
                 * search where the function is used and replace it
                 * support none OOP, inline function
                 */
                if($tokens[$i-1]->type != T_OBJECT_OPERATOR && $tokens[$i-1]->type != T_DOUBLE_COLON){
                    $string_name = $tokens[$i]->content;
                    if( !(in_array($string_name,$int_functions['internal'])) and in_array($string_name, array_flip($this->FuncArray)) ){

                        $this->_fullclasses['classes']['NONE_OOP']['functions'][$string_name] = $string_name;

                        //if process is not practical analyze, obfuscate it
                        //if(!$analyze)
                        $tokens[$i]->content = $this->FuncArray[$string_name];
                    }
                }
            }
        }
        $contents = $tokens;

        if( Input::has('Analyze') ){
            //echo '<pre>';
            //print_r(array_merge_recursive($this->_fullclasses,array('classes_exists' => $this->_classes)));
            //echo '</pre>';
            if(!empty($this->_classes)){
                return array_merge_recursive($this->_fullclasses,array('classes_exists' => $this->_classes));
            }else{
                return $this->_fullclasses;
            }

        }else{
            return $contents;
        }

    }

    public function ShowArrays() {

        $html = '<br>&nbsp;<br><hr color="#000000" height=1 noshade><h3>Replaced elements :</h3>';

        $html .= MagicalHelpers::DisplayArray( $this->ClassArray, "Found classes that will be replaced", $BgColor="FFF0D0");

        $html .= MagicalHelpers::DisplayArray( $this->getFuncPack(), "Found functions that will be replaced", $BgColor="FFF0D0");

        if(Input::has('ReplaceRoutes'))
            $html .= MagicalHelpers::DisplayArray( $this->ClassArray, "Write New routes from replaced functions in classes", $BgColor="FFF0D0");

        if(Input::has('ReplaceConstants'))
            $html .= MagicalHelpers::DisplayArray( $this->ConstArray, "Found constants that will be replaced", $BgColor="8DCFF4");

        ksort( $this->VarArray );

        $html .= MagicalHelpers::DisplayArray($this->getVarPack() , "Found variables that will be replaced", $BgColor="89CA9D");

        //$html .= MagicalHelpers::DisplayArray( $this->UdExcVarArray, "User Defined Exclude Variables", $BgColor="BFBFBF");

        //$html .= MagicalHelpers::DisplayArray( $this->FileArray, "Scanned Files", $BgColor="FA8B68");

        $html .= '<br><hr color="#000000" height=1 noshade>';

        $html .= '<b>Download The Project</b> : <a class="button red" href="'.URL::to('/get/'.WORKS_SPACE_ID.'/project.zip').'">Download !</a>';

        $html .= '<h3>Number of userdefined elements to be replaced :</h3>'.
            'Classes: '.sizeof( $this->ClassArray ).'<br>'.
            'Functions: '.sizeof(  $this->getFuncPack() ).'<br>'.
            'Variables: '.sizeof(  $this->getVarPack() ).'<br>'.
            'Constants: '.sizeof( $this->ConstArray ).'<br>';
        //'<br>Scanned Files: '.sizeof( $this->FileArray ).'<br>'.

        $this->resetAllPack();
        $this->resetExcluded();

        return $html;
    }

}