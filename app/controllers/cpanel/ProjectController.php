<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Cpanel;

use CpanelController;
use Debugbar;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Input;
use Projects;
use Redirect;
use View;

class ProjectController extends CpanelController
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Session::forget('excluded');

        $this->layout->content = View::make('admin.project.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        Session::forget('excluded');

        $this->layout->content = View::make('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $blenc = (Input::has('blenciT')) ? 1 : 0;

        if (Input::get('ciphers') == 'fw') $ciphers = 'laravel';
        elseif (Input::get('ciphers') == 'none') $ciphers = 'none';
        else $ciphers = false;

        $class = (Input::has('ReplaceClasses')) ? 'classes' : '0';
        $func = (Input::has('ReplaceFunctions')) ? 'functions' : '0';
        $vars = (Input::has('ReplaceVariables')) ? 'vars' : '0';

        $obfus = implode(",", array($class, $func, $vars));

        $project = Projects::create(array(
            'title' => Input::get('project_title'),
            'user_id' => \Sentry::getUser()->getId(),
            'excluded' => (Session::has('excluded')) ? serialize(Session::get('excluded')) : false,
            'files' => implode(",", Input::get('files')),
            'obfus' => $obfus,
            'blenc' => $blenc,
            'ciphers' => $ciphers,
            'has_report' => (Input::get('PDF_Report') == 1) ? 1 : false,
            'dl_folder' => current(Input::get('project_folder'))
        ));

        $project->save();
        return Redirect::back()->with('flash_error', 'the project was added successfully, check history page');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {

    }

    function analyze($FolderID = null, $FileID = null)
    {

        $FolderID = (!is_null($FolderID)) ? $FolderID : Input::get('FolderID');
        $FileID = (!is_null($FileID)) ? $FileID : Input::get('FileID');

        $data = $this->scan($FolderID, $FileID);

        $data['FileID'] = $FileID;

        $data['FileKey'] = Input::get('FileKey');

        /**
         * {"classes":{
         * "0":"dbconnector",
         * "dbconnector":{
         * "vars":{"_singleton":"_singleton","_connection":"_connection","HOST":"HOST","USER_NAME":"USER_NAME","USER_PASSWORD":"USER_PASSWORD","DB_NAME":"DB_NAME","class":"class"},"existent_vars":{"_connection":"_connection","HOST":"HOST","USER_NAME":"USER_NAME","USER_PASSWORD":"USER_PASSWORD","DB_NAME":"DB_NAME"},
         * "functions":{"getInstance":"getInstance","close":"close"}}}}
         * dbconnector1
         * Array(
         * [vars] => Array(
         * [_singleton] => _singleton
         * )
         * [existent_vars] => Array(
         * [_connection] => _connection
         * )
         * [functions] => Array
         * (
         * [getInstance] => getInstance
         * )
         * )
         */
        $body = View::make('admin.project.tree')->with($data)->render();

        return $body;
    }

    function scan($path, $FileID)
    {

        $MagicFetch = new \MagicalFetch();

        $LineArray = file_get_contents(base_path() . "/tmp/" . $path . "/" . $FileID);

        $data['content'] = $MagicFetch->PHPFetchContent($LineArray, true, $FileID);

        return $data;
    }

    function check()
    {

        $data['FolderID'] = Input::get('FolderID');
        $data['FileID'] = Input::get('FileID');

        $myfile = base_path() . "/tmp/" . $data['FolderID'] . "/" . $data['FileID'];

        $data['result'] = \MagicalHelpers::CheckSyntax($myfile);

        $body = View::make('admin.project.check')->with($data)->render();

        return $body;
    }

    function exclude()
    {
        $data['exclude']['FileID'] = Input::get('FileID');
        $data['exclude']['classes'] = Input::get('classes');
        $data['exclude']['functions'] = Input::get('functions');
        $data['exclude']['vars'] = Input::get('vars');

        $body = View::make('admin.project.exclude')->with($data)->render();

        return $body;
    }

    function history()
    {

        $data['projects'] = Projects::where('user_id', \Sentry::getUser()->getId())->get();

        Debugbar::info($data);

        $this->layout->content = View::make('admin.project.history')->with($data);

    }

}