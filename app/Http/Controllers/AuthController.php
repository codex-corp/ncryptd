<?php namespace App\Http\Controllers;

/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

use Sentry;
use Redirect;
use Input;
use OAuth;
use Validator;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller {

	/**
	 * Account sign in.
	 *
	 * @return View
	 */
	public function getSignin(){

//        $user = Sentry::findUserByLogin('hany.alsamman@gmail.com');
//
//        Sentry::login($user, false);

		// Is the user logged in?
		if (Sentry::check())
		{
			return Redirect::home();
		}

		// Show the page
		return view('frontend.auth.signin');
	}

	/**
	 * Account sign in form processing.
	 *
	 * @return Redirect
	 */
	public function postSignin()
	{

//        $this->beforeFilter('csrf', array('on' => 'post'));

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
			return Redirect::route('signin')->withInput()->withErrors($validator);
		}

                try
                {
                        // Try to log the user in
                        $user = Sentry::authenticate(Input::only('email', 'password'), Input::get('remember-me', 0));

                        // Redirect to the users page
                        return Redirect::route('signin')->with('success', Lang::get('auth/message.signin.success'));
                }
                catch (AuthenticationException $e)
                {
                        $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
                }

                return Redirect::route('signin')->withInput()->withErrors($this->messageBag);
        }

	/**
	 * Logout page.
	 *
	 * @return Redirect
	 */
	public function getLogout()
	{
		// Log the user out
		Sentry::logout();

		// Redirect to the users page
		return Redirect::route('home')->with('flash_error', 'Good Bye !');
	}

    public function loginWithLinkedin() {
        // get data from input
        $code = Input::get( 'code' );

        $linkedinService = OAuth::consumer('Linkedin');

        if ( !empty( $code ) ) {

            // This was a callback request from linkedin, get the token
            $token = $linkedinService->requestAccessToken( $code );
            // Send a request with it. Please note that XML is the default format.
            $result = json_decode($linkedinService->request('/people/~:(id,first-name,last-name,headline,member-url-resources,picture-urls::(original),location,public-profile-url,email-address)?format=json'), true);

            if(!empty($token)){
                $user = Sentry::findUserByLogin($result['emailAddress']);

                if ($user) {
                    // Log the user in
                    Sentry::login($user, false);

                    return Redirect::route('home');
                }

                // Register the user
                $user = Sentry::register(array(
                    'activated' =>  1,
                    'email'      => $result['emailAddress'],
                    'password'   => uniqid(time()),
                    'first_name' => $result['firstName'],
                    'last_name' => $result['lastName'],
                    'avatar'   => $result['pictureUrls']['values'][0],
                    'country'   => $result['location']['name']
                ));

                Sentry::login($user, false);

                return Redirect::route('account');
            }

        }// if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));
            // return to linkedin login url
            return Redirect::to( (string)$url );
        }
    }

    public function loginWithGithub() {
        // get data from input
        $code = Input::get( 'code' );

        $GitHubService = OAuth::consumer('GitHub');

        if ( !empty( $code ) ) {

            // This was a callback request from linkedin, get the token
            $token = $GitHubService->requestAccessToken( $code );
            // Send a request with it. Please note that XML is the default format.
            $result = json_decode($GitHubService->request('user'), true);

            if(!empty($token)){

                $user = Sentry::findUserByLogin($result['email']);

                if ($user) {
                    Sentry::login($user, false);

                    return Redirect::route('home');
                }

                // Register the user
                $user = Sentry::register(array(
                    'activated' =>  1,
                    'email'      => $result['email'],
                    'password'   => uniqid(time()),
                    'first_name' => $result['name'],
                    'avatar'   => $result['avatar_url'],
                    'country'   => (!empty($result['location'])) ? $result['location'] : false
                ));

                Sentry::login($user, false);

                return Redirect::route('account');

            }

        }// if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $GitHubService->getAuthorizationUri();

            // return to linkedin login url
            return Redirect::to( (string)$url );
        }
    }

    public function loginWithGoogle() {

        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

            if(!empty($token)){

                $user = Sentry::findUserByLogin($result['email']);

                if ($user) {
                    Sentry::login($user, false);

                    return Redirect::route('home');
                }

                // Register the user
                $user = Sentry::register(array(
                    'activated' =>  1,
                    'email'      => $result['email'],
                    'password'   => uniqid(time()),
                    'first_name' => $result['name'],
                    'avatar'   => $result['picture'],
                    'country'   => (!empty($result['location'])) ? $result['location'] : false
                ));

                Sentry::login($user, false);

                return Redirect::route('account');

            }

        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }
    }

}