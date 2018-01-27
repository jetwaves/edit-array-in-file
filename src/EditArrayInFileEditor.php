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
    private $_res = [];

    const TYPE_RAW                      = 0;    //  simple and headless str_pos
    const TYPE_VARIABLE                 = 1;    //  a variable of array.
    const TYPE_ARRAY_IN_VARIABLE_VALUE  = 2;    //  a value array in a variable
        //          eg.   $variable_lv1 = [  'key1_lv1' => [ 'targetKey' => 'targetValueToEdit', 'key2_lv2' => '...val_lv2' ], 'key2_lv1' => '....val2_lv2'  ] ;
    const TYPE_KV_PAIR                  = 3;    // simple kv pair
    const TYPE_ARRAY_IN_KV_PAIR         = 4;    // multi_level_kv_pair
        //         eg.   'some_key' =>   [  'key1_lv1' => [ 'targetKey' => 'targetValueToEdit', 'key2_lv2' => '...val_lv2' ], 'key2_lv1' => '....val2_lv2'  ] ;
    const TYPE_EOB_COMMA                = 5;    //    ],   end of bloc
    const TYPE_EOB_SEMI_COLON           = 6;    //    ];   end of bloc

    const INSERT_TYPE_RAW               = 0;    // simply insert one line
    const INSERT_TYPE_KV_PAIR           = 1;    // insert a kv pair as value
    const INSERT_TYPE_DATA_ONLY         = 2;    // insert a value array (without keys)


    function __construct($filename = null)
    {
        if(!$filename || !file_exists($filename)){
            throw new \Exception('Must provide a valid file name');
        }
        $this->_filleFullName = $filename;
        $this->parse();
    }

    /**
     * @return array
     */
    public function getEditArea()
    {
        return $this->_editArea;
    }

    private function parse(){
        $this->_contentArray = file($this->_filleFullName);
    }

    public function where($arrayName, $options = [], $type = self::TYPE_VARIABLE)
    {
        $this->_codesBeforeEditArea = [];
        $this->_codesAfterEditArea = [];
        $foundStart = false;
        $foundEnd = false;
        $eob = false;                             // end of target code bloc   (    ];   or  ],  )
        foreach ($this->_contentArray as $ln => $originalLine ) {
            $line = trim($originalLine);
//            if($line == '') continue;           // ignore empty lines(during test);
            if($foundStart == false){
                list($foundStart, $eob) = $this->match($line, $arrayName, $type);
                $this->_codesBeforeEditArea[] = $originalLine;
            }
            if($foundStart && $foundEnd == false){
                list($foundEnd, $eob) = $this->match($line, $eob, $type, true);
                $this->_editArea[] = $originalLine;
            }
            if($foundStart && $foundEnd){
                $this->_codesAfterEditArea[] = $originalLine;
            }

            $parseInfo =
                'ln         = '.$ln.PHP_EOL.
                '               line       = '.$line.PHP_EOL.
                '               pos        = '.strpos($originalLine, "aliases").PHP_EOL.
                '               foundStart = '.($foundStart?'true':'false').PHP_EOL.
                '               foundEnd   = '.($foundEnd?'true':'false').PHP_EOL.
                '               eob        = '.($eob?'true':'false').PHP_EOL.PHP_EOL;
            $this->_res[] = $parseInfo;
//            echo '     '.__method__.'() line:'.__line__.'   $parseInfo  = '.print_r($parseInfo, true);
        }
//        echo '     '.__method__.'() line:'.__line__.'   $this->_res  = '.print_r($this->_res, true);
        array_pop($this->_codesBeforeEditArea);
        array_splice($this->_codesAfterEditArea, 0, 1);
//        echo '     '.__method__.'() line:'.__line__.'   $this->_codesBeforeEditArea  = '.print_r($this->_codesBeforeEditArea, true);
//        echo '     '.__method__.'() line:'.__line__.'   $this->_editArea             = '.print_r($this->_editArea, true);
//        echo '     '.__method__.'() line:'.__line__.'   $this->_codesAfterEditArea   = '.print_r($this->_codesAfterEditArea, true);
        return $this;
    }

    // get the content of the founded array.
    public function get(){
//        echo '     '.__method__.'() line:'.__line__.'   $this->_codesBeforeEditArea  = '.print_r($this->_codesBeforeEditArea, true);
//        echo '     '.__method__.'() line:'.__line__.'   $this->_editArea             = '.print_r($this->_editArea, true);
//        echo '     '.__method__.'() line:'.__line__.'   $this->_codesAfterEditArea   = '.print_r($this->_codesAfterEditArea, true);
        return $this->_editArea;
    }

    public function find(){

    }

    public function delete(){

    }

    public function insert($data, $insertType = self::INSERT_TYPE_RAW ){
        $items = array_slice($this->_editArea, 1, count($this->_editArea) - 2, true);
        echo '     '.__method__.'() line:'.__line__.'   $items  = '.print_r($items, true);
        // delete "EOL" and ",",  then add ',EOL' for every line  -> then add the new line
        foreach($items as $key => $val){
            if(trim($val) == '') continue;
            $items[$key] = '        '.trim(trim($val), ',').','.PHP_EOL;
        }
        $items[] = '        '.$data;
        $this->_editArea = array_merge([$this->_editArea[0]] , $items,  array_slice($this->_editArea, -1) );
    }

    private function match($line, $keyword, $type, $matchEndOfBloc = null ){
        $endOfBlock = '';
        switch($type){
            case self::TYPE_VARIABLE :          // format like :    protected $middleware = [  ];    protected $routeMiddleware = [ ];
                $endOfBlock = '];';
                if(!$matchEndOfBloc){
                    $keyword = ' '.$keyword." = [";
                    $pos = self::contains($line, $keyword);
                    if($pos){
                        return [true, $endOfBlock];
                    }
                } else {
                    if(substr($line,0,1)=="]" && substr($line,1, 1) ==";"){
                        return [true, true];
                    }
                }
                break;
            case self::TYPE_KV_PAIR:            // format  like   'providers' => [  ],
                $endOfBlock = '],';
                if(!$matchEndOfBloc){
                    $keyword = "'".$keyword."' => [";
                    $pos = self::contains($line, $keyword);
                    if($pos){
                        return [true, $endOfBlock];
                    }
                } else {
                    if(substr($line,0,1)=="]" && substr($line,1, 1) ==","){
                        return [true, true];
                    }
                }
//                echo print_r(['line' => $line, 'keyword' => $keyword,   'pos' => $pos?'true': 'false']);
                break;
            case self::TYPE_ARRAY_IN_KV_PAIR:
                // 'providers' => [  ],

                $endOfBlock = '],';
                break;
            case self::TYPE_ARRAY_IN_VARIABLE_VALUE:
                // 'providers' => [  ],

                $endOfBlock = '];';
                break;
        }
        return [false, false];
    }

    // reconstruct the complete file in the memory
    public function save(){
        $this->_contentArray =  array_merge($this->_codesBeforeEditArea, $this->_editArea, $this->_codesAfterEditArea);
        return $this;
    }

    // write the edited content back(in memory) to the source file
    public function flush(){
        $content = implode('',$this->_contentArray);
        $saveToFileRes = file_put_contents($this->_filleFullName, $content);
        return $saveToFileRes;
    }






    public static function contains($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }

    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if (mb_substr($haystack, -mb_strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }


}