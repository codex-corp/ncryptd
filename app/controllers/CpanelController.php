<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class CpanelController extends BaseController
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
            $this->beforeFilter('auth');
        }
    }

    function getDashboard()
    {

        // Find the user using the user id
        //$user = Sentry::findUserByLogin('hany@codexc.com');
        // Log the user in
        //Sentry::login($user, false);

        $data['users'] = DB::table("users")->where('activated', 1)->count('id');

        $this->layout->content = View::make('admin.partials.dashboard',$data);
    }

    public function postLogin()
    {
        // Declare the rules for the form validation
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required|between:3,32',
        );

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails())
        {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        try
        {
            // Try to log the user in
            $user = Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

            Session::put('user_name', $user->first_name);
            Session::put('ID', $user->id);

            // Redirect to the users page
            return Redirect::to('/admin')->with('success', Lang::get('auth/message.signin.success'));
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {

        }
        // Ooops.. something went wrong
        return Redirect::back()->with('flash_error', 'Seems something wrong with username or password')->withInput();
    }

}

