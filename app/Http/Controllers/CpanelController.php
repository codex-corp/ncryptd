<?php namespace App\Http\Controllers;

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

use Sentry;
use Redirect;
use OAuth;

class CpanelController extends Controller
{
    public $layout = 'admin.layout';
    public $message = false;
    public $content;
    public $ok = true;

    public function __construct()
    {
        //$this->beforeFilter('csrf', array('on' => 'post'));
        if (!Sentry::check()){
            // Apply the auth filter
            $this->middleware('auth');
        }
    }

    function getDashboard()
    {

        // Find the user using the user id
        //$user = Sentry::findUserByLogin('hany@codexc.com');
        // Log the user in
        //Sentry::login($user, false);

        //$data['users'] = DB::table("users")->where('activated', 1)->count('id');

        //$this->layout->content = View::make('admin.partials.dashboard',$data);

        return Redirect::to('admin/project/create');
    }

}

