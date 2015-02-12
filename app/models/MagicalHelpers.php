<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

use Alchemy\Zippy\Zippy;
use \Illuminate\Support\Facades\Input;

class MagicalHelpers extends MagicalController
{

    static $TableColumns = 5;

    function __construct(){

    }

    /**
     * @param $path
     * @return bool
     */
    public static function DeleteDir($path)
    {
        $class_func = array(__CLASS__, __FUNCTION__);
        return is_file($path) ?
            @unlink($path) :
            array_map($class_func, glob($path.'/*')) == @rmdir($path);
    }

    /**
     * @return \Alchemy\Zippy\Archive\ArchiveInterface
     */
    public static function CompressProject(){
        $zippy = Zippy::load();
        // creates an archive.zip that contains a directory "folder" that contains
        // files contained in "/path/to/directory" recursively
        $archive = $zippy->create(TARGET_DIR.'/project.zip', array('project' => TARGET_DIR), $recursive = true);

        return $archive;
    }

    /**
     * @param $file
     * @param $dest
     * @return string
     */
    public function zip_upload($file, $dest){

        $zippy = Zippy::load();

        $archive = $zippy->open($file);

        $archive->extract($dest);

        $files = array();
        $files[0] = '';
        foreach($archive as $member){
            array_push($files, (string) $member);
        }

        unlink($file);

        return json_encode($files);
    }

    /**
     * @return string
     */
    public function postUpload(){

        $this->beforeFilter('csrf', array('on' => 'post'));

        $folder = substr(sha1(md5(time())), 0,10);

        if (!is_dir(base_path(). '/' . "tmp" . '/'.$folder)) {
            mkdir(base_path() . '/' . "tmp" . '/' . $folder, 0777);
        }

        $destinationPath = base_path(). '/' . "tmp" . '/'. $folder .'/';

        if(Input::hasFile('myfile')){

            $upload = array();

            $file = Input::file('myfile'); // your file upload input field in the form should be named 'file'

            if(is_array($file))
            {
                foreach($file as $part) {

                    $extension = $part->getClientOriginalExtension(); //if you need extension of the file

                    if($extension == 'zip' || $extension == 'php' || $extension == 'js'){
                        //$renamed = substr(sha1(md5(time().$part->getClientOriginalName())), 0,10);
                        //$filename  = $renamed.'.'.$extension;
                        $filename = $part->getClientOriginalName();

                        $part->move($destinationPath, $filename);
                        $upload[$folder]= $destinationPath.$filename;
                    }
                }
            }else{

                //$renamed = substr(sha1(md5(time().$file->getClientOriginalName())), 0,10);
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                //$filename  = $renamed.'.'.$extension;
                $filename = $file->getClientOriginalName();

                if($extension == 'zip' || $extension == 'php' || $extension == 'js'){

                    $uploadSuccess  = $file->move($destinationPath, $filename);

                    if($uploadSuccess && $extension == 'zip'){

                        $upload = $this->zip_upload($destinationPath . $filename, $destinationPath);
                        $temp = json_decode($upload);
                        $temp[0] = $folder;
                        return json_encode($temp);
                    }else{
                        $upload[$folder]= $destinationPath.$filename;
                    }

                    return json_encode($upload);

                }else{
                    //error
                }
            }

            return json_encode($upload);
        }
    }

    /**
     * @param $salt
     * @status not in use
     * @return string
     */
    public function random_string($salt) {
        $number=round(substr(md5(uniqid($salt, true)), 0, 8)/mt_rand(1,10));
        if (!empty($this->algos)) $algo=$this->algos[mt_rand(0,(count($this->algos)-1))];
        $hash=hash($algo,$number);
        return $hash;
    }

    /**
     * @param $text
     * @return string
     */
    static function encode_string($text) {
        for ($i=0;$i<=strlen($text)-1;$i++) {
            $chr=ord(substr($text,$i,1));
            if ($chr==32||$chr==34||$chr==39) $tmp[]=chr($chr); // Space, leave it alone.
            elseif ($chr==92&&preg_match('/\\\(n|t|r|s)/',substr($text,$i,2))) {
                // New line, leave it alone, and add the next char with it.
                $tmp[]=substr($text,$i,2);
                $i++; // Skip the next character.
            }
            else $tmp[]='\x'.strtoupper(base_convert($chr,10,16));
        }
        if (!empty($tmp)) $text=implode('',$tmp);
        return $text;
    }

    /**
     * @param $string
     * @return string
     */
    static function random_encode($string){

        $letters = str_split($string);
        $total = count($letters);
        $start_from = rand(0, $total);

        for($i = $start_from; $i < $total; ++$i)
            $letters[$i] =  MagicalHelpers::encode_string($letters[$i]);

        return implode('',$letters);
    }

    /**
     * function to find
     */
    public static function findit($pattern='*', $flags = 0, $path='')
    {
        $paths=glob($path.'*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);
        $files=glob($path.$pattern, $flags);
        foreach ($paths as $path) { $files=array_merge($files,MagicalHelpers::findit($pattern, $flags, $path)); }
        return $files;
    }


    /**
     * @param $directory
     * @return RegexIterator
     */
    public static function LocatePHP($directory)
    {
        return new RegexIterator(
            new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directory)
            ),
            '/\.php$/'
        );
    }

    /**
     * @param $index
     * @param $LineArray
     * @status WIP to support blade template
     * @return bool
     */
    public function findScriptTagInFile($index, $LineArray)
    {
        $WholeFile = strtolower(implode("", $LineArray));
        $Line = strtolower($LineArray[$index]);

        $LinePos = strpos($WholeFile, $Line);
        if($LinePos === false)
            return false;

        $offset = 0;
        $MaxPos = false;

        // find closest $what string
        while(true)
        {
            $pos = strpos($WholeFile, '{{', $offset);
            if($pos === false)
                break;

            if($pos>$LinePos)
                break;

            $offset = $pos+1;
            $MaxPos = $pos;
        }

        if($MaxPos === false)
            return false;

        // found one, now check if there is not and ending tag before our line
        $pos = strpos($WholeFile, '}}', $MaxPos);

        if($pos === false || $pos > $LinePos )
            return true;

        return false;
    }

    /**
     * @param $ArrayName
     * @param string $HeaderText
     * @param string $BgColor
     * @return string
     */
    static function DisplayArray($ArrayName, $HeaderText="", $BgColor="FFF0D0")
    {
        $sizeOf = sizeOf( $ArrayName );

        $html =    '<br>'."\n".
            '<TABLE WIDTH="100%" BORDER=0 CELLSPACING=1 CELLPADDING=3><TR><TD><FONT COLOR=#000><b>'.$HeaderText.'</b></FONT></TD></TR></TABLE>';
        if ( $sizeOf )
        {
            if ( $sizeOf > MagicalHelpers::$TableColumns ) $width = MagicalHelpers::$TableColumns; else $width = $sizeOf;
            $width = 100 / $width;

            $html .= '<TABLE WIDTH="100%" BORDER=0 style="padding: 5px"><TR>';

            $Cnt = 0;
            $Line = 0;
            foreach( $ArrayName as $Key => $Value )
            {
                $Cnt++;
                $html .= '<TD WIDTH="'.$width.'%" style="background-color:#'.$BgColor.'" ><b>'.$Key.'</b><br>'.$Value.'</TD>';
                if ( ( $Cnt % MagicalHelpers::$TableColumns) == 0  && ( $Cnt != $sizeOf ) )
                {
                    $html .= '</TR>';
                    $html .= '<TR>';
                    $Line ++;
                }
            }
            $i = $Cnt % MagicalHelpers::$TableColumns;
            if ( $i && $Line ) for ( ; $i < MagicalHelpers::$TableColumns; $i++ ) $html .= '<TD style="background-color:#'.$BgColor.'">&nbsp;</TD>';

            $html .= '</TR></TABLE>'."\n";
            flush();
        }
        else $html .= '<i>No match or no replace requested</i><br>';

        return $html;
    }

    /*
    we have to make sure that lines will be not longer than some constant,
    otherwise it can make problems with PHP
    */
    /**
     * @param $contents
     * @param int $MaxCharsInLine
     * @return mixed|string
     */
    static  function Concatenate($contents, $MaxCharsInLine = 100)
    {
        $linelength = 0;
        $replaced = 0;

        // get rid of useless lines first
        $contents = preg_replace( "/___HANY_NEWLINE___[ \t]*___HANY_NEWLINE___/m", "___HANY_NEWLINE___", $contents);

        while(($pos = strpos($contents, "___HANY_NEWLINE___")) !== false)
        {
            if($pos-$linelength<$MaxCharsInLine)
            {

                // replace with space
                $head = substr($contents, 0, $pos);
                $tail = substr($contents, $pos+18);
                $contents = $head.' '.$tail;
                $replaced++;
            }
            else
            {
                // replace with newline
                $head = substr($contents, 0, $pos);
                $tail = substr($contents, $pos+18);
                $contents = $head."\n".$tail;
                $linelength = $pos;
                $replaced++;
            }
        }

        // get rid of multiple spaces
        $contents = preg_replace( "/[ \t]+/", ' ', $contents);

        return $contents;
    }

    /**
     * @param $fileName
     * @return array
     * @throws Exception
     */
    static function CheckSyntax($fileName)
    {
        // If it is not a file or we can't read it throw an exception
        if(!is_file($fileName) || !is_readable($fileName))
            throw new Exception("Cannot read file ".$fileName);

        // Get the shell output from the syntax check command
        $output = shell_exec('php -l "'.$fileName.'"');

        // Try to find the parse error text and chop it off
        $syntaxError = preg_replace("/Errors parsing.*$/", "", $output, -1, $count);

        $error_msg = strstr($syntaxError, 'in', true);
        $error_line = strstr($syntaxError, 'line');

        // If the error text above was matched, throw an exception containing the syntax error
        if($count > 0)
            return array('error_msg'=> str_replace(', expect', '',$error_msg) , 'error_line'=> $error_line);
    }

    /**
     * @param $contents
     * @param $string
     * @return string
     */
    static function AddCopyRight($contents, $string){
        $tokens = token_get_all($contents);
        $founded = false;
        $output = '';
        foreach($tokens as $token) {
            if(is_array($token)) {
                list($index, $code, $line) = $token;
                switch($index) {
                    case T_OPEN_TAG: //<?php, <? or <%
                        $output .= ($founded == false)
                            ? '<?php '.PHP_EOL. $string .PHP_EOL
                            : '<?php '.PHP_EOL;
                        $founded = true;
                        break;
                    default:
                        $output .= $code;
                        break;
                }
                //if($founded === true) break;
            }else {
                $output .= $token;
            }
        }
        return $output;
    }

    /**
     * @param $items
     * @param $search_val
     * @param bool $key
     * @param array $org
     * @return array
     */
    static function find_position($items, $search_val, $key=false, $org = array()) {
        for($i=0;$i<count($items);$i++){
            if(array_search($search_val, $items[$i]) === false){
                // if value not found in array.....
            }
            else{
                //vars, functions, classes
                if($items[$i][$key] && !empty($items[$i][$key])){
                    return explode(",",$items[$i][$key]);
                }else{
                    return array();
                }
            }
        }
    }
}