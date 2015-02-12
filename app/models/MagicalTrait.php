<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

trait MagicalTrait
{

    var $FileExtArray,
        $UdExcConstArray,
        $StdObjRetFunctionsArray,
        $ConcatenateLines,
        $FilesToReplaceArray,
        $UdExcFileArray,
        $UdExcDirArray,
        $StdExcFileArray,
        $StdExcVarArray,
        $StdExcFuncArray;

    var $StartTime;

    var $TotalFileSizeRead = 0;
    var $TotalFileSizeWrite = 0;
    var $NewlinesReplaced = 0;

    var $UdExcFuncArray = array();

    var $UdExcVarArray = array(); // variables in this array will be not replaced

    var $ExVarArray = array();
    var $ConstObfucated = array();
    var $ObjectVarArray = array();

    var $LineArray = array();
    var $TemplateArray = array();
    var $FileArray = array();

    var $FileTemplateTags;

    var $UdExcVarArrayWild = array();
    var $UdExcVarArrayDliw = array();
    var $UdExcFileArrayRegEx = array();
    var $UdExcFileTemplateRegEx = array();
    var $UdExcDirArrayRegEx = array();

    var $TemplateVars = array();

    var $ExcludedLines = array();
    var $CopyrightText; // without this it was making double

    var $StdReplaceComments;

    var $MaxFiles = 2000;       // Maximum of processed files
    //var $_POBSMaxRepeats = 100;  //Maximum cycle repeats - protects against unlimited cycles in case
    var $html = '';

    /**
     * @var $this ->_classes included all classes in files
     * @var $this ->_fullclasses is @array included each class and all functions related to it
     * @var $this ->FuncArray is @array included all functions and class if requested
     * @var $this ->ConstArray is @array included all constants definded in file
     * @var $this ->VarArray is @array included all vars definded in file
     */
    public $_globals = array();
    public $_classes = array();
    public $_functions = array();
    public $_fullclasses = array();

    public $FuncArray = array();
    public $ConstArray = array();
    public $VarArray = array();
    public $ClassArray = array();
    public $ObjectArray = array();

    public $class = false;
    public $function = false;
    public $algos;        // To keep up with various variables.

    public $existent_vars = array();

    public $MagicFetch;

    /**
     *
     */
    function __construct()
    {

        $this->CopyrightText = str_replace("\r", "", trim(Input::get('CopyrightText')));
        $this->StartTime = time();

        /**
         * @extends()  @include()  @section()  @overwrite  @lang()  @choice() @show
         * @stop  @yield  @if()  @elseif()  @else  @endif  @unless()  @endunless  @for()
         * @endfor  @foreach()  @endforeach  @while()  @endwhile  {{-- --}}
         */
        $this->FileTemplateTags = array('@extends',
                                        '@section',
                                        '@overwrite',
                                        '@lang',
                                        '@choice',
                                        '@show',
                                        '@stop',
                                        '@yield',
                                        '@if',
                                        '@elseif',
                                        '@else',
                                        '@endif',
                                        '@unless',
                                        '@endunless',
                                        '@for',
                                        '@endfor',
                                        '@foreach',
                                        '@endforeach',
                                        '@while',
                                        '@endwhile'
        );

        // only files with defined extensions will be processed
        // if you want to process also files without any suffix, add "." to the array
        // example: $FileExtArray = array("php","php3","php4","php5","inc",".");
        $this->FileExtArray = array("php");

        $this->StdExcFileArray = array('Dummy Entry');

        //$LineExclude = '';  // do not obfuscate lines that contain specified patters
        // be careful using this pattern, dont specify any string that can be accidentally
        // a part of some of your code. It is matched as a string, not as regular expression.
        // Also consider all the dependencies of non-obfuscated lines.
        // Example of use:
        $this->LineExclude = '__EXCLUDE__';
        // then put comment containing __HANY_EXCLUDE__ to every line you dont want to obfuscate
        // like: $val = myfunction($a, $b); // __HANY_EXCLUDE__ (this line wil be not obfuscated)

        // standard variables that should not be replaced
        // variables, for which their key will be not replaced
        // for exaplle for CONFIGS['REMOTE_ADDR'], the REMOTE_ADDR string will be not replaced
        // dont replace any var object or normal var have same const or define key
        $this->StdExcVarArray = array(
            "_ENV",
            "argv",
            "argc",
            "PHPSESSID",
            "PHP_SELF",
            "GLOBALS",
            "_COOKIE",
            "_GET",
            "_POST",
            "_SESSION",
            "_FILES",
            "_REQUEST",
            "_SERVER",
            "this",
            "HTTP_SERVER_VARS",
            "HTTP_GET_VARS",
            "HTTP_POST_VARS",
            "HTTP_POST_FILES",
            "HTTP_SESSION_VARS",
            "HTTP_COOKIE_VARS",
            "HTTP_GET_VARS",
            "HTTP_GET_VARS",
            "HTTP_GET_VARS"
        );

        // all functions, that return objects (require special handling)
        $this->StdObjRetFunctionsArray = array(
            "mysql_query",
            "mysql_result",
            "mysql_affected_rows",
            "mysql_error",
            "mysql_fetch_row",
            "mysql_fetch_object",
            "mysql_fetch_array",
            "mysql_connect",
            "mysql_select_db",
            "register_shutdown_function",
            "mysql_close"
        );

        // types of comments that have to be replaced
        // available types are: '/**/','//' and '#'
        $this->StdReplaceComments = array('/**/', '//', '#');

        // constants in this array will be not replaced
        $this->UdExcConstArray = array('Dummy Entry');

        // functions in this array will be not replaced
        $this->StdExcFuncArray = array(
            "__autoload",
            "__clone",
            "__construct",
            "__destruct"
        );

        // files that will be excluded from obfuscation
        // you can use start convertion, like '*cat_*.php'
        // the files will be copied to the target directory
        $this->UdExcFileArray = array('routes.php');

        // directories that will be excluded from obfuscation
        // you can use star convention, like '/*mydirname*'
        // it is recommended to use '/' in the beginning of directory name if you want to filter directory beginning with specified string
        // WARNING: specified directories with all its content will be NOT processed and NOT copied to the target directory
        // if you are using them in your PHP code, you have to copy them by hand
        $this->UdExcDirArray = array();

        $this->algos = hash_algos();
    }

    /**
     *
     */
    public static function setExcluded()
    {
        $excluded = json_decode(Input::get('excluded'), true);

        if (Session::has('excluded')) {
            if (is_array($excluded) && sizeof($excluded) > 0) {
                $current = Session::get('excluded');
                $current = array_merge($excluded, $current);
                Session::put('excluded', $current);
                //Debugbar::info(Session::get('excluded'));
            }
        } else {
            $allData = $excluded;
            Session::put('excluded', $allData);
            //Debugbar::info(Session::get('excluded'));
        }
    }

    /**
     * @return bool
     */
    protected function getExcluded()
    {
        if (is_array(Session::get('excluded'))) {

            return Session::get('excluded');
        }
        return false;
    }

    /**
     * @param $file
     */
    protected function fetchExcluded($file)
    {
        if (is_array(Session::get('excluded'))) {

            $excluded = Session::get('excluded');
            $this->UdExcVarArray = MagicalHelpers::find_position($excluded, "$file", 'vars');
            $this->UdExcFuncArray = MagicalHelpers::find_position($excluded, "$file", 'functions');

        }
    }

    /**
     *
     */
    protected function resetExcluded()
    {
        Session::forget('excluded');
    }

    /**
     * @param bool $file
     */
    protected function setFileInProcess($file = false)
    {
        Session::put('FileInProcess', $file);
    }

    /**
     * @return mixed
     */
    protected function getFileInProcess()
    {
        return Session::get('FileInProcess');
    }

}