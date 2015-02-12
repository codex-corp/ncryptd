<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

/**
 * This class Obfuscate / encodes the PHP code to that it becomes hard to read.
 *
 * @see The higher the ENCODING_LEVEL, the code becomes harder to read. However the filesize and executing time will also increase as ENCODING_LEVEL goes higher.
 *
 * @usage
 * $obfuscator= new PhpObfuscator('hany');
 * $files = $obfuscator->findit('*.php',0,app_path().'/controllers');
 * foreach ($files as $file) {
 * $obfuscator->obfuscate($file,'none');
 * if($obfuscator->hasErrors()){
 * $errors=$obfuscator->getAllErrors();
 * echo "<pre>";
 * print_r($errors);
}

}
 *
 */
Class PhpObfuscator{

    private $fileName="";
    private $obfuscatedFilePostfix="obfuscated";
    private $obfuscateFileName="";
    private $errors=array();
    private $level=false;
    private $key;
    private $singleton_key = false;

    /**
     * constructor function
     *
     * @param string $obfuscatedFilePostfix
     */
    public function __construct($key='',$obfuscatedFilePostfix=""){

        $this->level = '';
        $this->key = $key;

        if (trim($obfuscatedFilePostfix)!="") {
            $this->obfuscatedFilePostfix=$obfuscatedFilePostfix;
        }

        Crypt::setKey($this->key);
    }

    public function run(){

        $files = $this->findit('*.php',0,app_path().'/controllers');

        //if(file_exists($moveit.'/'.'keys.inc')) unlink($moveit.'/'.'keys.inc');

        foreach ($files as $file) {

            /**
             * obfuscate all file where selected in $files then move it '/home/hany/public_html/laravel' folder
             * search in path base_path() '/home/hany/public_html/laravel/'
             */
            $this->obfuscate($file,'/home/hany/public_html/laravel','/home/hany/public_html/laravel/none/');

            if($this->hasErrors()){
                $errors=$this->getAllErrors();
                echo "<pre>";
                print_r($errors);
            }

        }
    }

    /**
     * function to help
     */
    public function reverse_strrchr($haystack, $needle)
    {
        $pos = strrpos($haystack, $needle);
        if ($pos === FALSE)return $haystack;
        return substr($haystack, 0, $pos + 1);
    }

    /**
     * function to find
     */
    public function findit($pattern='*', $flags = 0, $path='')
    {
        $paths=glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
        $files=glob($path.$pattern, $flags);
        foreach ($paths as $path) { $files=array_merge($files,$this->findit($pattern, $flags, $path)); }
        return $files;
    }

    /**
     * Return first doc comment found in this file.
     *
     * @return string
     */
    function getFileDocBlock($file)
    {
        $docComments = array_filter(
            token_get_all( $file ), function($entry) {
                return $entry[0] == T_DOC_COMMENT;
            }
        );
        $fileDocComment = array_shift( $docComments );
        return $fileDocComment[1].PHP_EOL;
    }

    /**
     * function to obfuscate a file
     *
     * @param string $fileName
     * @return 
     */
    public function obfuscate($fileName,$mymove=false,$moveit=false) {

        if (trim($fileName)=="") {
            $this->errors[]="File Name cannot be blank in function: ".__FUNCTION__;
            return false;
        }
        if (!is_readable($fileName)){
            $this->errors[]="Failed to open file: $fileName in the function: ".__FUNCTION__;
            return false;
        }

        $this->fileName=$fileName;

        $ext='php';
        $pos=strrpos($this->fileName,".");
        $fileName=substr($this->fileName,0,$pos);

        $this->obfuscateFileName=$obfuscateFileName=$fileName.".".$this->obfuscatedFilePostfix.".".$ext;

        if(($fp=fopen($obfuscateFileName,"w+"))===false){
            $this->errors[]="Failed to open file: $obfuscateFileName for writing in the function: ".__FUNCTION__;
            return false;
        }
        else {
            fwrite($fp,"<?php \r\n");

            $line=file_get_contents($this->fileName);

            ## get comments from file
            $comments = $this->getFileDocBlock($line);
            ## and add it to file !
            fwrite($fp,$comments);

            $line=str_replace(array("<?php", "<?", "?>"),"",$line);
            $line=trim($line);

            $line=$this->encodeString($line);
            $line.="\r\n"; //add new empty line
            fwrite($fp,$line);
            fwrite($fp,"?>");

            //$this->key = md5(filesize($this->fileName).basename($this->fileName));
            //$this->singleton_key = basename($this->fileName).':'.$this->key.PHP_EOL;
            //$this->singleton_key = 'if($file == \''.basename($this->fileName).'\') Crypt::setKey(\''.$this->key.'\');'.PHP_EOL;

        }
        fclose($fp);

        if($moveit != false){

            $search_in = basename($mymove);

            preg_match("/$search_in\/(.*)\.php$/",$this->fileName, $matches);

            $path = $this->reverse_strrchr($matches[1], '/');

            $moveto = $moveit.'/'.$path;

            if(!file_exists($moveto))
                mkdir($moveto, 0777, true);

            rename($obfuscateFileName, $moveto.'/'.basename($this->fileName));

            //file_put_contents($moveit.'/'.'keys.inc', $this->singleton_key, FILE_APPEND | LOCK_EX);
        }

        return $obfuscateFileName;
    }

    function laravel_magic($string,$level=false){

        //$_S = '\x64\x65\x63\x72\x79\x70\x74'; //Decrypt
        //$_G = '\x43\x72\x79\x70\x74'; //Crypt
        $string = Crypt::encrypt(gzcompress($string,$level));
        $string = '$_S = "\x64\x65\x63\x72\x79\x70\x74"; $_G = "\x43\x72\x79\x70\x74"; @eval(gzuncompress($_G::$_S("'.$string.'")));';
        return $string;
    }

    function normal_magic($string,$level=false){

        //$_S = '\x64\x65\x63\x72\x79\x70\x74'; //Decrypt
        //$_G = '\x43\x72\x79\x70\x74'; //Crypt
        $string = Crypt::encrypt(gzcompress($string,$level));
        $string = '$_S = "\x64\x65\x63\x72\x79\x70\x74"; $_G = "\x43\x72\x79\x70\x74"; @eval(gzuncompress($_G::$_S("'.$string.'")));';
        return $string;
    }
	    
    /**
     * Function to encode the file content before writing it
     *
     * @param string $string
     * @param [int $levels]
     * @return string
     */
    private function encodeString($string, $levels=""){
        if (trim($levels)=="") {
        	$levels=rand(1,9);
        }
        $levels=(int) $levels;
	    $magic = $this->generate_magic($string,$levels);
        return $magic;
    }
    
    /**
     * Function to return all encountered errors
     * @return array
     */
    public function getAllErrors(){
        return $this->errors;
    }

    /**
     * Function to find if there were any errors
     *
     * @return boolean
     */
    public function hasErrors(){
        if (count($this->errors)>0) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>
