<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Cpanel;

use CpanelController;

use Input;
use Tzookb\TBMsg\Facade\TBMsg;
use Debugbar;
use Sentry;
use Cartalyst\Sentry\Users;
use Cartalyst\Sentry\Groups;

class ChatController extends CpanelController {

    /**
     * Inject the models.
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return [{"msgID":1,"content":"sfsdf\n","created_at":"2014-05-21 18:32:22","userId":1,"first_name":"hany","avatar":"0"},
     *          {"msgID":2,"content":"\nl;'","created_at":"2014-05-21 18:33:29","userId":1,"first_name":"hany","avatar":"0"}]
     */
    public function getUserConversation()
    {
        $user_id = Input::get('user_id'); //between this user id
        $limit = Input::get('limit'); //between this user id

        $conv_id = TBMsg::getConversationByTwoUsers($user_id, Sentry::getUser()->getId());

        //Get the conversation id of two users
        $result = TBMsg::getConversationMessages($conv_id, $user_id, $limit);

        TBMsg::markReadAllMessagesInConversation($conv_id, Sentry::getUser()->getId(), $user_id);

        return (!empty($result)) ? json_encode($result) : json_encode(array("error" => 'empty'));
    }

    public function addMessageToConversation(){

        $user_id = Input::get('user_id'); //send to user id
        $msg = \Purifier::clean(Input::get('msg'));
        $status = 0;

        if(!empty($msg)){
            /**
             * $senderId, $receiverId, $content
             * return @boolean
             */
            $status = TBMsg::sendMessageBetweenTwoUsers(Sentry::getUser()->getId(), $user_id, $msg);
        }

        return ($status) ? 1 : 0;
    }

    public function getUnreadConversationMessages()
    {
        $user_id = Input::get('user_id'); //between this user id

        $conv_id = TBMsg::getConversationByTwoUsers($user_id, Sentry::getUser()->getId());

        //Get the conversation id of two users
        $result = TBMsg::getUnreadConversationMessages($conv_id, Sentry::getUser()->getId(), $user_id);

        TBMsg::markReadAllMessagesInConversation($conv_id, Sentry::getUser()->getId(), $user_id);

        return (!empty($result)) ? json_encode($result) : json_encode(array("error" => 'empty'));
    }

    public function getOnline(){
       return \View::make('admin.chat.online')->render();
    }

    public function getChat(){
        return \View::make('admin.chat.index')->render();
    }

}
