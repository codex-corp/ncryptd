<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

class Projects extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projects';

    protected $fillable = array('title', 'user_id', 'files', 'excluded', 'has_report', 'ciphers', 'obfus', 'blenc', 'dl_folder');

}