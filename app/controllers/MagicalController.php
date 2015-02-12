<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class MagicalController extends BaseController
{

    use MagicalTrait {
        MagicalTrait::__construct as private __MagicConstruct;
    }

    function __construct()
    {
        $this->__MagicConstruct();
    }

    function run()
    {

        $data['FileExtArray'] = $this->FileExtArray;
        $data['UdExcFuncArray'] = $this->UdExcFuncArray;
        $data['UdExcConstArray'] = $this->UdExcConstArray;
        $data['StdObjRetFunctionsArray'] = $this->StdObjRetFunctionsArray;

        $data['UdExcVarArray'] = $this->UdExcVarArray;
        $data['UdExcFileArray'] = $this->UdExcFileArray;
        $data['UdExcDirArray'] = $this->UdExcDirArray;

        $headers = array('Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate', 'Pragma' => 'no-cache', 'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT');

        //return View::make('magical.index',$data);
        return Response::make(View::make('magical.index', $data), 200, $headers);
    }

    function process()
    {

        $this->MagicFetch = new MagicalFetch();

        if (Input::has("project_folder")) {

            $getfolderID = Input::get("project_folder");

            reset($getfolderID);

            ## get the workspace ID
            $folderID = current($getfolderID);

            ## set the work space folder
            define("WORKS_SPACE_ID", $folderID);

            /**
             * Copy files from temp to workspace
             */
            rename(base_path() . "/tmp/" . $folderID, base_path() . "/workspace/$folderID");

            define("SOURCE_DIR", base_path() . "/workspace/$folderID");

            chmod(SOURCE_DIR, 0777);

            $target_path = base_path() . "/projects/$folderID";

            ## create project directory
            if (!is_dir($target_path)) mkdir($target_path, 0777);

            ## set the target folder
            define("TARGET_DIR", $target_path);
        }


        if (!(is_readable(SOURCE_DIR))) {
            echo "Error. Source Directory " . SOURCE_DIR . " is not readable. Program will terminate<br>";
            exit;
        }

        if (!(is_writeable(TARGET_DIR))) {
            echo "Error. Target Directory " . TARGET_DIR . " is not writeable. Program will terminate<br>";
            exit;
        }

        $data['html'] = $this->ScanSourceFiles();

        krsort($this->FuncArray);
        krsort($this->ConstArray);
        krsort($this->VarArray);
        sort($this->FileArray);

        $data['html'] .= $this->WriteTargetFiles();

        $data['html'] .= $this->MagicFetch->ShowArrays();

        if (Input::get('ciphers') == 'fw') {
            $this->CiphersLaravel();
        } elseif (Input::get('ciphers') == 'none') {
            $this->CiphersNonFW();
        }

        if (Input::has('blenciT')) {
            $data['blenc_report'] = $this->BLENCiT();

            if (Input::has('BLENC_Report') && Input::get('BLENC_Report') == 1) {
                PDF::loadHTML($data['blenc_report'])->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(TARGET_DIR . '/blenc/blenc_report.pdf');
            }
        }

        if (Input::has('PDF_Report') && Input::get('PDF_Report') == 1) {
            PDF::loadHTML($data['html'])->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save(TARGET_DIR . '/guide.pdf');
        }

        MagicalHelpers::CompressProject();

        MagicalHelpers::DeleteDir(SOURCE_DIR);

        return View::make('magical.process', $data)->with($data)->render();

    }

    function ScanSourceFiles($path = '', $template = false)
    {
        $html = '';

        //$dir = dir(SOURCE_DIR.$path.'/');

        //Fixme: should make it one process to exclude an File / Directory

        foreach (MagicalHelpers::LocatePHP(SOURCE_DIR . $path . '/') as $file) {

            $FileNaam = end(@explode("/", $file));

            $fileName = $path . '/' . $FileNaam;
            $excludeFile = FALSE;
            $excludeDirectory = FALSE;

            if (is_file(SOURCE_DIR . $fileName) && pathinfo(SOURCE_DIR . $fileName, PATHINFO_EXTENSION) == 'php') {
                // check if file has the proper suffix
                $extpos = strrpos($FileNaam, ".");

                if ($extpos > 0)
                    $Suffix = substr($FileNaam, $extpos + 1);
                else
                    $Suffix = md5(rand()); // generate some non existing extension

                if (!in_array($Suffix, $this->FileExtArray)) {
                    $html .= "- <font color=red>Excluded:</font> Filename: " . substr($fileName, 1) . " file is not allowed, Will copy only !<br>\n";
                }

                if ((in_array($Suffix, $this->FileExtArray) || ($extpos == 0 && in_array(".", $this->FileExtArray))) && sizeof($this->FileArray) < $this->MaxFiles) {

                    // check if the file is in UdExcFileArray
                    foreach ($this->UdExcFileArrayRegEx as $value) {
                        // compare file name with regular expression
                        if (preg_match($value, $FileNaam)) {
                            $excludeFile = TRUE;
                        }
                    }

                    if ($excludeFile == FALSE) {
                        // it should be PHP file
                        $html .= "<span class='semi-bold'>+ Scanning File: " . substr($fileName, 1) . "</span> <span>Done</span><br>\n";
                        array_push($this->FileArray, substr($fileName, 1));

                        //if(in_array(basename($fileName), $this->UdExcFileTemplateRegEx)){
                        //if(preg_match("/blade.php/", basename($fileName))){

                        //echo count($fileName);


                        if (!in_array($fileName, $this->UdExcFileTemplateRegEx)) {

                            $this->LineArray = file_get_contents(SOURCE_DIR . $fileName);

                            $this->MagicFetch->PHPFetchContent($this->LineArray, false, $FileNaam);
                        }

                        //{{ HTML::style('assets/css/colors.css')}}
                        /** $template = str_replace('<', '<?php echo \'<\'; ?>', $this->LineArray);
                         * $template = preg_replace('~\{{(\w+)\}}~', '<?php $this->showVariable(\'$1\'); ?>', $this->LineArray);
                         *
                         * $template = preg_replace('~\{foreach:(\w+)\}~', '<?php foreach ($this->data[\'$1\'] as $ELEMENT): $this->wrap($ELEMENT); ?>', $this->LineArray);
                         * $template = preg_replace('~\{endforeach:(\w+)\}~', '<?php $this->unwrap(); endforeach; ?>', $this->LineArray);**/

                        flush();

                    } else {

                        // file was excluded, just copy it
                        $html .= "- <font color=blue>Excluded</font>, Filename: " . substr($fileName, 1) . " just will copy it !<br>\n";

                        copy(SOURCE_DIR . $fileName, TARGET_DIR . $fileName);
                    }
                } elseif (Input::get('CopyAllFiles')) {
                    $html .= "- Copy Filename: " . substr($fileName, 1) . "<br>\n";
                    copy(SOURCE_DIR . $fileName, TARGET_DIR . $fileName);
                }
            } else if (Input::get('RecursiveScan') && is_dir(SOURCE_DIR . $fileName) && $FileNaam != "." && $FileNaam != "..") {

                $html .= "<font color=blue>+ Add All Sub Directory in " . SOURCE_DIR . " to queue!</font><br>";

                // check if the directory is in UdExcDirArray
                foreach ($this->UdExcDirArrayRegEx as $value) {
                    // compare directory name with regular expression
                    if (preg_match($value, SOURCE_DIR . $fileName))
                        $excludeDirectory = TRUE;
                }

                if ($excludeDirectory == TRUE) {
                    $html .= "<font color=blue>Directory " . SOURCE_DIR . $fileName . " excluded, not copied!</font><br>";
                } else {

                    if (!is_dir(TARGET_DIR . $fileName)) {
                        if (@mkdir(TARGET_DIR . $fileName, 0777)) $html .= '+ Creating Directory : ' . $fileName . '.<br>';
                        else $html .= '- Creating Directory : ' . $fileName . ' <FONT COLOR=orange>Warning: Creation failed.</b></FONT><br>';
                    }

                    $html .= $this->ScanSourceFiles($fileName);

                }
            }
        }
        return $html;
    }

    function WriteTargetFiles()
    {

        $html = '<h3>Processing :</h3>' . '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=3><TR>';
        $count = 0;
        $FileRead = SOURCE_DIR . "/";

        foreach (MagicalHelpers::LocatePHP($FileRead) as $file) {

            $count++;
            $FileName = end(@explode("/", $file));

            $this->setFileInProcess($FileName);

            $html .= '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=3><TR>';
            $html .= '<TR><TD>' . $count . ' - ' . $FileName . '</TD><TD>';

            $FileStartTime = time();
            $html .= ': <FONT COLOR=red>Done</FONT>';

            $contents = $this->ReplaceThem($FileName);
            $contents = (new Obfuscator)->obfuscateFileContents($contents, $FileName);

            /**
             * Write files
             */
            $FdWrite = fopen(TARGET_DIR . "/" . $FileName, 'w');
            fwrite($FdWrite, $contents);
            fclose($FdWrite);
            clearstatcache();
            $this->TotalFileSizeWrite += filesize(TARGET_DIR . "/" . $FileName);

            $html .= ' - Elapsed Time: ' . (time() - $FileStartTime) . ' sec.';

            $html .= '</TD></TR></TABLE>';
            flush();
        }

        exec("find " . TARGET_DIR . " -type d -exec chmod 0777 {} +");
        exec("find " . TARGET_DIR . "  -type f -exec chmod 0666 {} +");

        $html .= '&nbsp;<br>' .
            '&nbsp;<br><hr color="#000000" height=1 noshade><h3>Stats :</h3>' .
            '<b>Elapsed Time: ' . (time() - $this->StartTime) . ' sec</b><br>' .
            '&nbsp;<br>' .
            '<b>Total FileSize of parsed Files: ' . number_format($this->TotalFileSizeRead / 1024, 2) . ' Bytes<br>' .
            'Total FileSize of written Files: ' . number_format($this->TotalFileSizeWrite / 1024, 2) . ' Bytes</b><br>';

        return $html;
    }

    function ReplaceThem($FileName)
    {

        $FileRead = SOURCE_DIR . "/" . $FileName;
        $FileWrite = TARGET_DIR . "/" . $FileName;

        // check if file has the proper suffix
        $extpos = strrpos($FileName, ".");

        if ($extpos > 0)
            $Suffix = substr($FileName, $extpos + 1);
        else
            $Suffix = md5(rand()); // generate some non existing extension

        $this->NewlinesReplaced = 0;

        $FdRead = fopen($FileRead, 'rb');

        $contents_arr = file($FileRead);

        $contents = '';
        $LinesExcluded = 0;
        $this->ExcludedLines = array();

        // take care of lines that should be excluded from obfuscation
        if ($this->LineExclude == '')
            $contents = fread($FdRead, filesize($FileRead));
        else {
            for ($i = 0; $i < count($contents_arr); $i++) {
                // check if line should be excluded
                if (strpos($contents_arr[$i], $this->LineExclude) !== false) {
                    $this->ExcludedLines[$LinesExcluded] = $contents_arr[$i];
                    $contents .= '__HANY_@LINE@_EXCLUDED_' . $LinesExcluded;
                    $LinesExcluded++;
                } else
                    $contents .= $contents_arr[$i];
            }
        }

        $this->TotalFileSizeRead += filesize($FileRead);
        fclose($FdRead);

        $ch = new CommentHandler(Input::get('KeptCommentCount'));

        // we have to process comments in any case
        $ch->RemoveComments($contents);

        $contents = preg_replace("/[\r\n]{2,}/m", "\n", $contents); // REMOVE EMPTY LINES AND DOS "\r\n"
        $contents = preg_replace("/[ \t]{2,}/m", ' ', $contents); // REMOVE TOO MANY SPACE OR TABS (but also in output text...)

        if (Input::get('RemoveIndents')) {
            $contents = preg_replace("/([;\}]{1})\n[ \t]*/m", "\\1\n", $contents);  // REMOVE INDENT TABS and SPACES
            //$contents =  preg_replace('~[\r\n]+~', "\r\n", $contents); // REMOVE EMPTY LINE
        }

        //check file type
        $filetype = (in_array($FileName, $this->UdExcFileTemplateRegEx)) ? 'template' : 'php';

        //restore the first $KeptCommentCount comments
        $ch->RestoreComments($contents);

        if (Input::get('KeptCommentCount') > 0) {
            $ch->SetKeepFirst(Input::get('KeptCommentCount'));

        } else {
            //restore the first $KeptCommentCount comments
            $ch->SetKeepFirst(9999);
        }

        if (Input::has('ConcatenateLines') && Input::get('ConcatenateLines')) {
            $contents = preg_replace('/\n/sme', "___HANY_NEWLINE___", $contents);
            $contents = MagicalHelpers::Concatenate($contents);
        }

        // replace placeholders with excluded lines
        if ($this->LineExclude != '' && count($this->ExcludedLines) > 0) {
            for ($i = 0; $i < count($this->ExcludedLines); $i++) {
                $contents = str_replace('__HANY_@LINE@_EXCLUDED_' . $i, $this->ExcludedLines[$i], $contents);
            }
        }

        // now add copyright text
        if (Input::get('CopyrightPHP') == 1 && in_array($Suffix, $this->FileExtArray)) {
            $contents = MagicalHelpers::AddCopyRight($contents, Input::get('CopyrightText'));
        }

        if (Input::get('ReplaceRoutes') && is_file(SOURCE_DIR . "/routes.php")) {
            $mycontent = file_get_contents(SOURCE_DIR . "/routes.php");
            foreach ($this->_classes as $class) {
                //[postUpload] => F61a80a71
                if (in_array($class, $this->_fullclasses['classes'])) {
                    foreach ($this->FuncArray as $fun_name => $fun_replace) {
                        if (preg_match('/(' . $class . ')/', $mycontent, $matches)) {
                            if ($matches[0] == $class) {
                                //search for the function name like "HomeController@getHome"
                                $mycontent = preg_replace('/(' . $class . ')@*(' . $fun_name . ')/', $class . '@' . $fun_replace, $mycontent); // objects
                            }
                        }
                    }
                }
            }
            file_put_contents(TARGET_DIR . "/routes.php", $mycontent);
            unset($mycontent);
        }

        if (Input::get('compact_code') == 1) {
            $compactor = new MagicalCompactor();
            $contents = $compactor->compact($contents);
        }

        return $contents;

    }

    public function CiphersLaravel()
    {

        $files = MagicalHelpers::findit('*.{php}', GLOB_BRACE, TARGET_DIR . '/');

        if (Input::has('cipher_key'))
            $unencrypted_key = Input::get('cipher_key');
        else
            $unencrypted_key = md5(time()); //$key = md5(time());

        $Cipher = new PhpObfuscator($unencrypted_key);

        $file_time = time();

        foreach ($files as $file) {

            $file_name = basename($file);

            $path = pathinfo($file);

            //$last_mod = filemtime($file);

            $source_code = file_get_contents($file);

            $comments = $Cipher->getFileDocBlock($source_code);

            //This covers old-asp tags, php short-tags, php echo tags, and normal php tags.
            $contents = preg_replace(array('/^<(\?|\%)\=?(php)?/', '/(\%|\?)>$/'), array('',''), $source_code);

            /**
             * get filename correctly
             */
            $guard = '$SssdDwwq = pathinfo(__FILE__ ); if( (int) filemtime($SssdDwwq["dirname"]."/". $SssdDwwq["filename"]. ".php") != ' . $file_time . ') return die("fuckers");' . PHP_EOL;

            //$lock = 'if( $_SERVER["SERVER_NAME"] != "alryadah.sa" || $_SERVER["HTTP_HOST"] != "www.alryadah.sa" ) exit("Sorry, you can only use this on alryadah.sa.com");';

            $contents = $Cipher->laravel_magic($guard . $contents);

            file_put_contents($path['dirname'] . '/' . $file_name, "<?php" . PHP_EOL . $comments . $contents . PHP_EOL . " ?>");

            touch($file, $file_time);
        }
    }

    public function CiphersNonFW()
    {

        $files = MagicalHelpers::findit('*.{php}', GLOB_BRACE, TARGET_DIR . '/');

        if (Input::has('cipher_key'))
            $unencrypted_key = Input::get('cipher_key');
        else
            $unencrypted_key = md5(time()); //$key = md5(time());

        $Cipher = new PhpObfuscator($unencrypted_key);

        $file_time = time();

        foreach ($files as $file) {

            $file_name = basename($file);

            $path = pathinfo($file);

            //$last_mod = filemtime($file);

            $source_code = file_get_contents($file);

            $comments = $Cipher->getFileDocBlock($source_code);

            $contents = trim(str_replace(array('<?php', '<?', '?>'), array('', '', ''), $source_code));

            /**
             * get filename correctly
             */
            $guard = '$SssdDwwq = pathinfo(__FILE__ ); if( (int) filemtime($SssdDwwq["dirname"]."/". $SssdDwwq["filename"]. ".php") != ' . $file_time . ') return die("fuckers");' . PHP_EOL;

            //$lock = 'if( $_SERVER["SERVER_NAME"] != "alryadah.sa" || $_SERVER["HTTP_HOST"] != "www.alryadah.sa" ) exit("Sorry, you can only use this on alryadah.sa.com");';

            $contents = $Cipher->normal_magic($guard . $contents);

            file_put_contents($path['dirname'] . '/' . $file_name, "<?php" . PHP_EOL . $comments . $contents . PHP_EOL . " ?>");

            touch($file, $file_time);
        }
    }

    function BLENCiT()
    {

        $files = MagicalHelpers::findit('*.{php}', GLOB_BRACE, TARGET_DIR . '/');

        /**
         * BLENC blowfish unencrypted key
         * blenc.key
         * @link http://giuseppechiesa.it/_dropplets/php-blenc-quick-start-guide
         */
        if (Input::has('unencrypted_key'))
            $unencrypted_key = Input::get('unencrypted_key');
        else
            $unencrypted_key = md5(time()); //$key = md5(time());


        $html = "";

        foreach ($files as $file) {

            $file_name = basename($file);

            $source_code = file_get_contents($file);

            //This covers old-asp tags, php short-tags, php echo tags, and normal php tags.
            $contents = preg_replace(array('/^<(\?|\%)\=?(php)?/', '/(\%|\?)>$/'), array('',''), $source_code);

            $html .= "<br> BLENC blowfish unencrypted key: $unencrypted_key" . PHP_EOL;
            $html .= "<br> BLENC file to encode: " . $file_name . PHP_EOL;

            //file_put_contents('blencode-log', "---\nFILE: $file_name\nSIZE: ".strlen($contents)."\nMD5: ".md5($contents)."\n", FILE_APPEND);

            if (!is_dir(TARGET_DIR . '/blenc')) mkdir(TARGET_DIR . '/blenc', 0777);

            $redistributable_key = blenc_encrypt($contents, TARGET_DIR . '/blenc/' . $file_name, $unencrypted_key);

            $html .= "<br> BLENC size of content: " . strlen($contents) . PHP_EOL;

            /**
             * Server key
             * key_file.blenc
             */
            file_put_contents(TARGET_DIR . '/blenc/' . 'key_file.blenc', $redistributable_key . PHP_EOL);

            $html .= "<br> BLENC redistributable key file key_file.blenc updated." . PHP_EOL;

            //exec("cat key_file.blenc >> /usr/local/etc/blenckeys");

        }
        return $html;

    }

}
