<?php
class Pro {

	protected $config	= array(); // Variable to store the configuration

    private $_baseURI;
    private $_timeout = 10;
    private $_token;

    /**
     * Constructor
     *
     * @param String $baseURI Base URI
     *
     * @return void
     */
    public function __construct($config = array())
    {
		$ci =& get_instance();
		
		// Try to load Phil's curl library
		//$ci->load->spark('curl/1.3.0');
		
		// Loads the configuration
		$ci->load->config('firebase', TRUE);

		// Store the configuration as array into the variable
		$this->config = $ci->config->item('firebase');
		
		// Override any default configuration
		$this->initialize($config);    
	}
	public function initialize($config = array())
	{
		foreach ($config as $key => $value)
		{
			if (isset($this->config[$key]))
			{
				$this->config[$key] = $value;
			}
		}
		$this->setBaseURI($this->config['app_path']);
		$this->setTimeOut($this->config['timeout']);
		$this->setToken($this->config['app_key']);
	}

/*
    public function test() {
        return "string";
    }*/

  function show_hello_world()
  {
		$ci =& get_instance();

		$ci->load->config('firebase', TRUE);

		$this->config = $ci->config->item('firebase');

    return $this->config;
  }
      /**
     * Sets Token
     *
     * @param String $token Token
     *
     * @return void
     */
    public function setToken($token)
    {
        $this->_token = $token;
    }

    /**
     * Sets Base URI, ex: http://yourcompany.firebase.com/youruser
     *
     * @param String $baseURI Base URI
     *
     * @return void
     */
    public function setBaseURI($baseURI)
    {
        $baseURI .= (substr($baseURI, -1) == '/' ? '' : '/');
        $this->_baseURI = $baseURI;
    }

    /**
     * Returns with the normalized JSON absolute path
     *
     * @param String $path to data
     */
    private function _getJsonPath($path)
    {
        $url = $this->_baseURI;
        $path = ltrim($path, '/');
        $auth = ($this->_token == '') ? '' : '?auth=' . $this->_token;
        return $url . $path . '.json' . $auth;
    }

    /**
     * Sets REST call timeout in seconds
     *
     * @param Integer $seconds Seconds to timeout
     *
     * @return void
     */
    public function setTimeOut($seconds)
    {
        $this->_timeout = $seconds;
    }
    
     /**
     * Reading data from Firebase
     * HTTP 200: Ok
     *
     * @param String $path Path
     *
     * @return Array Response
     */
    public function get($path)
    {
        try {
            $ch = $this->_getCurlHandler($path, 'GET');
            $return = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $return = null;
        }
        return $return;
    }

}