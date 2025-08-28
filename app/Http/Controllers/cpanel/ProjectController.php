<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace App\Http\Controllers\Cpanel;

use App\Http\Controllers\CpanelController;
use App\Http\Controllers\Nand\MagicalFetch;
use App\Http\Controllers\Nand\MagicalHelpers;
use Debugbar;
use Response;
use Session;
use Redirect;
use View;
use Illuminate\Http\Request;
use Sentry;

class ProjectController extends CpanelController
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(Session::has('excluded'))
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
        if(Session::has('excluded'))
            Session::forget('excluded');

        return View::make('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $blenc = ($request->has('blenciT')) ? 1 : 0;

        if ($request->get('ciphers') == 'fw') $ciphers = 'laravel';
        elseif ($request->get('ciphers') == 'none') $ciphers = 'none';
        else $ciphers = false;

        $class = ($request->has('ReplaceClasses')) ? 'classes' : '0';
        $func = ($request->has('ReplaceFunctions')) ? 'functions' : '0';
        $vars = ($request->has('ReplaceVariables')) ? 'vars' : '0';

        $obfus = implode(",", array($class, $func, $vars));

        $project = Projects::create(array(
            'title' => $request->get('project_title'),
            'user_id' => Sentry::id(),
            'excluded' => (Session::has('excluded')) ? serialize(Session::get('excluded')) : false,
            'files' => implode(",", $request->get('files')),
            'obfus' => $obfus,
            'blenc' => $blenc,
            'ciphers' => $ciphers,
            'has_report' => ($request->get('PDF_Report') == 1) ? 1 : false,
            'dl_folder' => current($request->get('project_folder'))
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

        $FolderID = (!is_null($FolderID)) ? $FolderID : request('FolderID');
        $FileID = (!is_null($FileID)) ? $FileID : request('FileID');

        $data = $this->scan($FolderID, $FileID);

        $data['FileID'] = $FileID;

        $data['FileKey'] = request('FileKey');

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

        $MagicFetch = new MagicalFetch();

        $LineArray = file_get_contents(base_path() . "/tmp/" . $path . "/" . $FileID);

        $data['content'] = $MagicFetch->PHPFetchContent($LineArray, true, $FileID);

        return $data;
    }

    function check()
    {

        $data['FolderID'] = request('FolderID');
        $data['FileID'] = request('FileID');

        $myfile = base_path() . "/tmp/" . $data['FolderID'] . "/" . $data['FileID'];

        $data['result'] = MagicalHelpers::CheckSyntax($myfile);

        $body = View::make('admin.project.check')->with($data)->render();

        return $body;
    }

    function exclude()
    {
        $data['exclude']['FileID'] = request('FileID');
        $data['exclude']['classes'] = request('classes');
        $data['exclude']['functions'] = request('functions');
        $data['exclude']['vars'] = request('vars');

        $body = View::make('admin.project.exclude')->with($data)->render();

        return $body;
    }

    function history()
    {

        $data['projects'] = Projects::where('user_id', Sentry::id())->get();

        Debugbar::info($data);

        $this->layout->content = View::make('admin.project.history')->with($data);

    }

}