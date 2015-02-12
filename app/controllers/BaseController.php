<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class BaseController extends Controller
{

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;
	var $currency;
	var $scheduler;
	var $menu = false;

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// CSRF Protection
		$this->beforeFilter('csrf', array('on' => 'post'));

		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
