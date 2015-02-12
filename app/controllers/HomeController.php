<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class HomeController extends BaseController {

    public function __construct(){

        parent::__construct();
    }

    /**
     * get index @getIndex
     * @return view
     */
    public function getIndex()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return View::make('index', compact('users'));
    }

    public function getPage($slug)
    {
        $data['getPage'] = Page::where('slug', '=', $slug)->first();

        $data['search_mode'] = false;

        if (Sentry::check())
        $data['user'] = User::with('data')->find(Sentry::getUser()->getId());

        // if page is an form and user not logged in please redirect to sign-in
        if($data['getPage']->front == 1){
            if (!Sentry::check())
                return Redirect::route('signin');
        }
        // if page not found redirect to home page
        if ( is_null($data['getPage']) )
            return Redirect::route('home');

        return View::make('index' , $data);
    }

    static function checkStaticPage($view){
        try
        {
            View::getFinder()->find('static.'.$view);
            return true;
        }
        catch (InvalidArgumentException $error)
        {
            // View does not exist...
            return false;
        }
    }

    static function MainPages($lang='en'){

        $mypage = Page::where("category_id",'=',0);

        if($lang == 'ar') $mypage->where("lang_id",1); else $mypage->where("lang_id",2);

        $mypage->orWhereNull("category_id");

        return $mypage->get();
    }

    static function hasPage($slug){

        $hasPage = Page::where("slug",'=',$slug)->first();

        if(!empty($hasPage)){
            return ($hasPage->category_id) ? $hasPage->category_id : false;
        }else{
            return false;
        }
    }

    static function SubPages($id){

        $pages = Page::where("category_id",'=',$id)->get();

        if(!$pages->isEmpty()){
            return $pages;
        }else{
            return false;
        }
    }

    static function GetPageIntro($id){

        $page = Page::where("category_id",'=',0)->where("slug",'=',$id)->take(1)->get();

        if(!$page->isEmpty()){
            foreach($page as $item){
                $check = Page::where("category_id",'=',$item->id)->first();
                if(!empty($check))
                    return $check->content;
            }
        }else{
            return false;
        }
    }

    function postContact(){

        $data = Input::all();

        //Debugbar::info($data);

        //Mail::pretend();

        $body = View::make('emails.welcome_body')->with($data)->render();

        $mydata = array('content' => $body);

        Mail::send('emails.welcome', $mydata, function($message)
        {
            $message->from('no-replay@ncryptd.com', 'Contact Form');
            $message->to('manager@ncryptd.com', 'Webmaster')->subject("You've been contacted");
        });
        return Redirect::back()->with('flash_error', 'message sent');
    }
}