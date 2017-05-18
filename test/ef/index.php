<?php 

class Model implements ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    static private $config;
    private $configarray;

    private function __construct() {
        // init
        $this->configarray = array("Binzy" => "Male", "Jasmin" => "Female");
    }

    public static function instance() {
        //
        if (self::$config == null) {
            self::$config = new Model();
        }
        return self::$config;
    }
    //检查一个偏移位置是否存在
    function offsetExists($index) {
        return isset($this->configarray[$index]);
    }

    //获取一个偏移位置的值
    function offsetGet($index) {
        return $this->configarray[$index];
    }

    //设置一个偏移位置的值
    function offsetSet($index, $newvalue) {
        $this->configarray[$index] = $newvalue;
    }
    //复位一个偏移位置的值
    function offsetUnset($index) {
        unset($this->configarray[$index]);
    }
}

$config = Model::instance();
print_r($config);
echo $config->Binzy;

//ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable

?>