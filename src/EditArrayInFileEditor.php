<?php
/**
 * Created by PhpStorm.
 * User: jetwaves
 * Date: 18-1-25
 * Time: 下午6:26
 */

namespace Jetwaves\EditArrayInFile;


class Editor {
    private $_filleFullName = '';
    private $_contentArray = [];

    private $_codesBeforeEditArea = [];
    private $_codesAfterEditArea = [];
    private $_editArea = [];

    const TYPE_RAW = 0;                 //  simple and headless str_pos
    const TYPE_VARIABLE = 1;        //  change
    const TYPE_KV_PAIR = 2;

    const INSERT_TYPE_DATA_ONLY = 0;
    const INSERT_TYPE_KV_PAIR = 0;

    function __construct($filename = null)
    {
        if(!$filename || !file_exists($filename)){
            throw new \Exception('Must provide a valid file name');
        }
        $this->_filleFullName = $filename;
        $this->parse();
    }

    private function parse(){
        $this->_contentArray = file($this->_filleFullName);
    }
    
    public function where($arrayName, $type = self::TYPE_VARIABLE)
    {
        foreach ($this->_contentArray as $line ) {

        }

        echo print_r($this->_contentArray);
    }

    public function find(){

    }

    public function delete(){

    }

    public function insert($data, $insertType = self::INSERT_TYPE_DATA_ONLY ){


    }

    private function match($line, $keyword, $type ){
            switch($type){
                case self::TYPE_VARIABLE :
                    //  protected $middleware = [
                    //  protected $routeMiddleware = [

                    break;
                case self::TYPE_KV_PAIR:

                    break;
            }
        return false;
    }

    // write the edited content back to the source file
    public function flush(){

    }



}