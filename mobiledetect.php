<?php

class MobileDetect {

	// Device constants
	const DEVICE_ANDROID	= "android";
	const DEVICE_BLACKBERRY	= "blackberry";
	const DEVICE_IPHONE		= "iphone";
	const DEVICE_IPHONE4	= "iphone4";
	const DEVICE_OPERA		= "opera";
	const DEVICE_PALM		= "palm";
	const DEVICE_WINDOWS	= "windows";
	const DEVICE_GENERIC	= "generic";
	const DEVICE_IPAD		= "ipad";
	const DEVICE_IPOD		= "ipod";
	const DEVICE_KINDLE		= "kindle";
	const DEVICE_NORMAL		= "normal";
	
    /**
     * Hold the device useragent
     * 
     * @var string
     */
    private $_useragent;
    
    /**
     * Boolean that is set to true if 
     * the current device is mobile
     * 
     * @var bool
     */
    private $_isMobile     	= false;
    
    /**
     * Device booleans that get set when 
     * the devices matches
     * 
     * @var bool
     */
    private $_isAndroid    	= null;
    private $_isBlackberry 	= null;
    private $_isIphone		= null;
    private $_isIphone4		= null;
    private $_isOpera      	= null;
    private $_isPalm       	= null;
    private $_isWindows    	= null;
    private $_isGeneric    	= null;
    private $_isIpad		= null;
    private $_isIpod		= null;
    private $_isKindle		= null;
    
    /**
     * Regular expressions for the different devices
     * 
     * @var array
     */
    private $_devices 		= array(
        "android"       => "android",
        "blackberry"    => "blackberry",
    	"ipad"			=> "ipad",
	"iphone4"        => "(8A293|4_3)",
        "iphone"        => "(iphone|ipod)",
        "ipod"        => "ipod",
        "opera"         => "(opera mini|opera mobi)",
        "palm"          => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino|webos)",
        "windows"       => "(iemobile|smartphone|windows phone|htc_hd2)",
        "kindle"       => "kindle",
        "generic"       => "(kindle|mobile|mmp|midp|o2|pda|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|u970)"
    );

    /**
	 * Constructor
	 *
	 * @access public
	 * @return void
	 */
    public function __construct() {
        $this->_useragent = $_SERVER['HTTP_USER_AGENT'];
        foreach ($this->_devices as $device => $regexp) {
        	if ($this->IsDevice($device) && $this->_isMobile == FALSE) {
    	        $this->_isMobile = true;
            }
        }
    }
    
    /**
	 * Check if surfing with a particular device
	 *
	 * @access private
	 * @param string $device
	 * @return bool
	 */
    private function IsDevice($device) {
	
        $var    = "_is" . ucfirst($device);
        $this->$var = @$this->$var === null ? (bool) preg_match("/" . $this->_devices[strtolower($device)] . "/i", $this->_useragent) : $this->$var;
        if ($device != 'generic' && $this->$var == true) {
            $this->_isGeneric = false;
        }

        return $this->$var;
    }
    
    /**
     * Get the device type 
     * 
     * @param public
     * @return string
     */
    public function GetDevice(){
    	foreach($this->_devices as $device_string => $regex){
    		if( $this->IsDevice($device_string) ){
    			return $device_string;
    		}
    	}
    	return self::DEVICE_NORMAL;
    }

    /**
     * Call methods like this IsMobile() | IsAndroid() | IsIphone() | IsBlackberry() | IsOpera() | IsPalm() | IsWindows() | IsGeneric() | IsIpad() through IsDevice()
     *
     * @access public
     * @param string $name
     * @param array $arguments
     * @return bool
     */
    public function __call($name, $arguments) {
        $device = substr($name, 2);
        if ($name == "Is" . ucfirst($device)) {
            return $this->IsDevice($device);
        } else {
            trigger_error("Method $name is not defined", E_USER_ERROR);
        }
    }


    /**
     * Returns true if surfing on a mobile device
     *
     * @access public
     * @return bool
     */
    public function IsMobile() {
        return $this->_isMobile;
    }

}
