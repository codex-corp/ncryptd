<?php
/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 * @copyright Ncryptd.com 2013 - 2015
 * @version 1.1 BETA
 * @license The Ncryptd is open-sourced software licensed under the [MIT](http://opensource.org/licenses/MIT)
 */

namespace Controllers\Obfuscator;

use Illuminate\Support\Facades\Session;

trait ReportArraysTrait
{

    /**
     * @var array
     */
    private $FuncPack = array();
    /**
     * @var array
     */
    private $ConstPack = array();
    /**
     * @var array
     */
    private $VarPack = array();
    /**
     * @var array
     */
    private $ClassPack = array();
    /**
     * @var array
     */
    private $ObjectPack = array();

    /**
     * @return array
     */
    public function getClassPack()
    {
        return $this->ClassPack;
    }

    /**
     * @param array $ClassPack
     */
    public function setClassPack($ClassPack)
    {
        $this->ClassPack = $ClassPack;
    }

    /**
     * @return array
     */
    public function getConstPack()
    {
        return $this->ConstPack;
    }

    /**
     * @param array $ConstPack
     */
    public function setConstPack($ConstPack)
    {
        $this->ConstPack = $ConstPack;
    }

    /**
     * @return array
     */
    public function getFuncPack()
    {
        //Retrieving An Item And Forgetting It
        return Session::get('FuncPack');
    }

    /**
     * @param array $FuncPack
     */
    public function setFuncPack($FuncPack)
    {
        $FuncPack = (Session::has('FuncPack')) ? array_merge(Session::get('FuncPack'), $FuncPack) : $FuncPack;

        Session::put('FuncPack', $FuncPack);
    }

    /**
     * @return array
     */
    public function getObjectPack()
    {
        return $this->ObjectPack;
    }

    /**
     * @param array $ObjectPack
     */
    public function setObjectPack($ObjectPack)
    {
        $this->ObjectPack = $ObjectPack;
    }

    /**
     * @return array
     */
    public function getVarPack()
    {
        //Retrieving An Item And Forgetting It
        return Session::get('VarPack');
    }

    /**
     * @param array VarPack
     */
    public function setVarPack($VarPack)
    {
        $VarPack = (Session::has('VarPack')) ? array_merge(Session::get('VarPack'), $VarPack) : $VarPack;

        Session::put('VarPack', $VarPack);
    }

    public function resetAllPack(){
        Session::forget('FuncPack');
        Session::forget('VarPack');
    }

}
