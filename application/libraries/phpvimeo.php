<?php
class phpVimeo
{
    const API_REST_URL = 'http://vimeo.com/api/rest/v2';
    const API_AUTH_URL = 'http://vimeo.com/oauth/authorize';
    const API_ACCESS_TOKEN_URL = 'http://vimeo.com/oauth/access_token';
    const API_REQUEST_TOKEN_URL = 'http://vimeo.com/oauth/request_token';

    const CACHE_FILE = 'file';

    private $_consumer_key = false;
    private $_consumer_secret = false;
    private $_cache_enabled = false;
    private $_cache_dir = false;
    private $_token = false;
    private $_token_secret = false;
    private $_upload_md5s = array();

    public function __construct($token = null, $token_secret = null)
    {
        $this->_consumer_key = "5ef7da650ff17b0404e6cd8b5ec5879f142d1097";
        $this->_consumer_secret = "KJFQhN4D0qLT3eIQL9+IpnGJqjnf3oqpA8Sn0iWyiNlmucx3ccxwsgoctHU0Tep1BRdBYYojMMaabZ0JxLCvbqdJdgiD7ryTbUgOl++IQEXGw0Cv/SKJccWpIdKBb1bj";

        if ($token && $token_secret) {
            $this->setToken($token, $token_secret);
        }
    }

    /**
     * Cache a response.
     *
     * @param array $params The parameters for the response.
     * @param string $response The serialized response data.
     */
    private function _cache($params, $response)
    {
        // Remove some unique things
        unset($params['oauth_nonce']);
        unset($params['oauth_signature']);
        unset($params['oauth_timestamp']);

        $hash = md5(serialize($params));

        if ($this->_cache_enabled == self::CACHE_FILE) {
            $file = $this->_cache_dir.'/'.$hash.'.cache';
            if (file_exists($file)) {
                unlink($file);
            }
            return file_put_contents($file, $response);
        }
    }

    /**
     * Create the authorization header for a set of params.
     *
     * @param array $oauth_params The OAuth parameters for the call.
     * @return string The OAuth Authorization header.
     */
    private function _generateAuthHeader($oauth_params)
    {
        $auth_header = 'Authorization: OAuth realm=""';

        foreach ($oauth_params as $k => $v) {
            $auth_header .= ','.self::url_encode_rfc3986($k).'="'.self::url_encode_rfc3986($v).'"';
        }

        return $auth_header;
    }

    /**
     * Generate a nonce for the call.
     *
     * @return string The nonce
     */
    private function _generateNonce()
    {
        return md5(uniqid(microtime()));
    }

    /**
     * Generate the OAuth signature.
     *
     * @param array $args The full list of args to generate the signature for.
     * @param string $request_method The request method, either POST or GET.
     * @param string $url The base URL to use.
     * @return string The OAuth signature.
     */
    private function _generateSignature($params, $request_method = 'GET', $url = self::API_REST_URL)
    {
        uksort($params, 'strcmp');
	$params = self::url_encode_rfc3986($params);

        // Make the base string
        $base_parts = array(
            strtoupper($request_method),
            $url,
            urldecode(http_build_query($params, '', '&'))
        );
        $base_parts = self::url_encode_rfc3986($base_parts);
        $base_string = implode('&', $base_parts);

        // Make the key
        $key_parts = array(
            $this->_consumer_secret,
            ($this->_token_secret) ? $this->_token_secret : ''
        );
        $key_parts = self::url_encode_rfc3986($key_parts);
        $key = implode('&', $key_parts);

        // Generate signature
        return base64_encode(hash_hmac('sha1', $base_string, $key, true));
    }

    /**
     * Get the unserialized contents of the cached request.
     *
     * @param array $params The full list of api parameters for the request.
     */
    private function _getCached($params)
    {
        // Remove some unique things
        unset($params['oauth_nonce']);
        unset($params['oauth_signature']);
        unset($params['oauth_timestamp']);

        $hash = md5(serialize($params));

        if ($this->_cache_enabled == self::CACHE_FILE) {
            $file = $this->_cache_dir.'/'.$hash.'.cache';
            if (file_exists($file)) {
                return unserialize(file_get_contents($file));
            }
        }
    }

    /**
     * Call an API method.
     *
     * @param string $method The method to call.
     * @param array $call_params The parameters to pass to the method.
     * @param string $request_method The HTTP request method to use.
     * @param string $url The base URL to use.
     * @param boolean $cache Whether or not to cache the response.
     * @param boolean $use_auth_header Use the OAuth Authorization header to pass the OAuth params.
     * @return string The response from the method call.
     */
    private function _request($method, $call_params = array(), $request_method = 'GET', $url = self::API_REST_URL, $cache = true, $use_auth_header = true)
    {
        // Prepare oauth arguments
        $oauth_params = array(
            'oauth_consumer_key' => $this->_consumer_key,
            'oauth_version' => '1.0',
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_nonce' => $this->_generateNonce()
        );

        // If we have a token, include it
        if ($this->_token) {
            $oauth_params['oauth_token'] = $this->_token;
        }

        // Regular args
        $api_params = array('format' => 'php');
        if (!empty($method)) {
            $api_params['method'] = $method;
        }

        // Merge args
        foreach ($call_params as $k => $v) {
            if (strpos($k, 'oauth_') === 0) {
                $oauth_params[$k] = $v;
            }
            else if ($call_params[$k] !== null) {
                $api_params[$k] = $v;
            }
        }

        // Generate the signature
        $oauth_params['oauth_signature'] = $this->_generateSignature(array_merge($oauth_params, $api_params), $request_method, $url);

        // Merge all args
        $all_params = array_merge($oauth_params, $api_params);

        // Returned cached value
        if ($this->_cache_enabled && ($cache && $response = $this->_getCached($all_params))) {
            return $response;
        }

        // Curl options
        if ($use_auth_header) {
            $params = $api_params;
        }
        else {
            $params = $all_params;
        }

        if (strtoupper($request_method) == 'GET') {
            $curl_url = $url.'?'.http_build_query($params, '', '&');
            $curl_opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30
            );
        }
        else if (strtoupper($request_method) == 'POST') {
            $curl_url = $url;
            $curl_opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($params, '', '&')
            );
        }

        // Authorization header
        if ($use_auth_header) {
            $curl_opts[CURLOPT_HTTPHEADER] = array($this->_generateAuthHeader($oauth_params));
        }

        // Call the API
        $curl = curl_init($curl_url);
        curl_setopt_array($curl, $curl_opts);
        $response = curl_exec($curl);
        $curl_info = curl_getinfo($curl);
        curl_close($curl);

        // Cache the response
        if ($this->_cache_enabled && $cache) {
            $this->_cache($all_params, $response);
        }

        // Return
        if (!empty($method)) {
            $response = unserialize($response);
            if ($response->stat == 'ok') {
                return $response;
            }
            else if ($response->err) {
                throw new VimeoAPIException($response->err->msg, $response->err->code);
            }

            return false;
        }

        return $response;
    }

    /**
     * Send the user to Vimeo to authorize your app.
     * http://www.vimeo.com/api/docs/oauth
     *
     * @param string $perms The level of permissions to request: read, write, or delete.
     */
    public function auth($permission = 'read', $callback_url = 'oob')
    {
        $t = $this->getRequestToken($callback_url);
        $this->setToken($t['oauth_token'], $t['oauth_token_secret'], 'request', true);
        $url = $this->getAuthorizeUrl($this->_token, $permission);
        header("Location: {$url}");
    }

    /**
     * Call a method.
     *
     * @param string $method The name of the method to call.
     * @param array $params The parameters to pass to the method.
     * @param string $request_method The HTTP request method to use.
     * @param string $url The base URL to use.
     * @param boolean $cache Whether or not to cache the response.
     * @return array The response from the API method
     */
    public function call($method, $params = array(), $request_method = 'GET', $url = self::API_REST_URL, $cache = true)
    {
        $method = (substr($method, 0, 6) != 'vimeo.') ? "vimeo.{$method}" : $method;
        return $this->_request($method, $params, $request_method, $url, $cache);
    }

    /**
     * Enable the cache.
     *
     * @param string $type The type of cache to use (phpVimeo::CACHE_FILE is built in)
     * @param string $path The path to the cache (the directory for CACHE_FILE)
     * @param int $expire The amount of time to cache responses (default 10 minutes)
     */
    public function enableCache($type, $path, $expire = 600)
    {
        $this->_cache_enabled = $type;
        if ($this->_cache_enabled == self::CACHE_FILE) {
            $this->_cache_dir = $path;
            $files = scandir($this->_cache_dir);
            foreach ($files as $file) {
                $last_modified = filemtime($this->_cache_dir.'/'.$file);
                if (substr($file, -6) == '.cache' && ($last_modified + $expire) < time()) {
                    unlink($this->_cache_dir.'/'.$file);
                }
            }
        }
        return false;
    }

    /**
     * Get an access token. Make sure to call setToken() with the
     * request token before calling this function.
     *
     * @param string $verifier The OAuth verifier returned from the authorization page or the user.
     */
    public function getAccessToken($verifier)
    {
        $access_token = $this->_request(null, array('oauth_verifier' => $verifier), 'GET', self::API_ACCESS_TOKEN_URL, false, true);
        parse_str($access_token, $parsed);
        return $parsed;
    }

    /**
     * Get the URL of the authorization page.
     *
     * @param string $token The request token.
     * @param string $permission The level of permissions to request: read, write, or delete.
     * @param string $callback_url The URL to redirect the user back to, or oob for the default.
     * @return string The Authorization URL.
     */
    public function getAuthorizeUrl($token, $permission = 'read')
    {
        return self::API_AUTH_URL."?oauth_token={$token}&permission={$permission}";
    }

    /**
     * Get a request token.
     */
    public function getRequestToken($callback_url = 'oob')
    {
        $request_token = $this->_request(
            null,
            array('oauth_callback' => $callback_url),
            'GET',
            self::API_REQUEST_TOKEN_URL,
            false,
            false
        );

        parse_str($request_token, $parsed);
        return $parsed;
    }

    /**
     * Get the stored auth token.
     *
     * @return array An array with the token and token secret.
     */
    public function getToken()
    {
        return array($this->_token, $this->_token_secret);
    }

    /**
     * Set the OAuth token.
     *
     * @param string $token The OAuth token
     * @param string $token_secret The OAuth token secret
     * @param string $type The type of token, either request or access
     * @param boolean $session_store Store the token in a session variable
     * @return boolean true
     */
    public function setToken($token, $token_secret, $type = 'access', $session_store = false)
    {
        $this->_token = $token;
        $this->_token_secret = $token_secret;

        if ($session_store) {
            $_SESSION["{$type}_token"] = $token;
            $_SESSION["{$type}_token_secret"] = $token_secret;
        }

        return true;
    }

    /**
     * Upload a video in one piece.
     *
     * @param string $file_path The full path to the file
     * @param boolean $use_multiple_chunks Whether or not to split the file up into smaller chunks
     * @param string $chunk_temp_dir The directory to store the chunks in
     * @param int $size The size of each chunk in bytes (defaults to 2MB)
     * @return int The video ID
     */
    public function upload($file_path, $use_multiple_chunks = false, $chunk_temp_dir = '.', $size = 2097152, $replace_id = null)
    {
        if (!file_exists($file_path)) {
            return false;
        }

        // Figure out the filename and full size
        $path_parts = pathinfo($file_path);
        $file_name = $path_parts['basename'];
        $file_size = filesize($file_path);

        // Make sure we have enough room left in the user's quota
        $quota = $this->call('vimeo.videos.upload.getQuota');
        if ($quota->user->upload_space->free < $file_size) {
            throw new VimeoAPIException('The file is larger than the user\'s remaining quota.', 707);
        }

        // Get an upload ticket
        $params = array(
		'upload_method' => 'streaming'
	);

        if ($replace_id) {
            $params['video_id'] = $replace_id;
        }

        $rsp = $this->call('vimeo.videos.upload.getTicket', $params, 'GET', self::API_REST_URL, false);
        $ticket = $rsp->ticket->id;
        $endpoint = $rsp->ticket->endpoint;

        // Make sure we're allowed to upload this size file
        if ($file_size > $rsp->ticket->max_file_size) {
            throw new VimeoAPIException('File exceeds maximum allowed size.', 710);
        }

	$this->_perform_upload($file_path, $endpoint);

        // Complete the upload
        $complete = $this->call('vimeo.videos.upload.complete', array(
            'filename' => $file_name,
            'ticket_id' => $ticket
        ));

        // Confirmation successful, return video id
        if ($complete->stat == 'ok') {
            return $complete->ticket->video_id;
        }
        else if ($complete->err) {
            throw new VimeoAPIException($complete->err->msg, $complete->err->code);
        }
    }

    public function _perform_upload($file_path, $upload_endpoint)
    {
        // We need a handle on the input file since we may have to send segments multiple times.
        $file = fopen($file_path, 'r');
        // PUTs a file in a POST....do for the streaming when we get there.
        $curl_opts = array(
            CURLOPT_PUT => true,
            CURLOPT_INFILE => $file,
            CURLOPT_INFILESIZE => filesize($file_path),
            CURLOPT_UPLOAD => true,
            CURLOPT_HTTPHEADER => array('Expect: ', 'Content-Range: replaced...')
        );

        // These are the options that set up the validate call.
        $curl_opts_check_progress = array(
            CURLOPT_PUT => true,
            CURLOPT_HTTPHEADER => array('Content-Length: 0', 'Content-Range: bytes */*')
        );

        // Perform the upload by streaming as much to the server as possible and ending when we reach the filesize on the server.
        $size = filesize($file_path);
        $server_at = 0;
        do {
            // The last HTTP header we set MUST be the Content-Range, since we need to remove it and replace it with a proper one.
            array_pop($curl_opts[CURLOPT_HTTPHEADER]);
            $curl_opts[CURLOPT_HTTPHEADER][] = 'Content-Range: bytes ' . $server_at . '-' . $size . '/' . $size;

            fseek($file, $server_at);   //  Put the FP at the point where the server is.

            try {
                var_dump($this->_request3($upload_endpoint, $curl_opts));   //Send what we can.
            } catch (\Vimeo\Exceptions\VimeoRequestException $exception) {
                // ignored, it's likely a timeout, and we should only consider a failure from the progress check as a legit failure
            }

            $progress_check = $this->_request3($upload_endpoint, $curl_opts_check_progress); //  Check on what the server has.
            // Figure out how much is on the server.
            list(, $server_at) = explode('-', $progress_check['headers']['Range']);
            $server_at = (int)$server_at;
        } while ($server_at < $size);
    }

    /**
     * URL encode a parameter or array of parameters.
     *
     * @param array/string $input A parameter or set of parameters to encode.
     */
    public static function url_encode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('phpVimeo', 'url_encode_rfc3986'), $input);
        } else if (is_bool($input)) {
            return $input ? 1 : 0;
        }
        else if (is_scalar($input)) {
            return str_replace(array('+', '%7E'), array(' ', '~'), rawurlencode($input));
        }
        else {
            return '';
        }
    }

    /**
     * Internal function to handle requests, both authenticated and by the upload function.
     *
     * @param string $url
     * @param array $curl_opts
     * @return array
     */
    private function _request3($url, $curl_opts = array()) {
	// Merge the options (custom options take precedence).
        $curl_opts = $curl_opts + array(
            CURLOPT_HEADER => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
        );

        // Call the API.
        $curl = curl_init($url);
        curl_setopt_array($curl, $curl_opts);
        $response = curl_exec($curl);
        $curl_info = curl_getinfo($curl);

        if(isset($curl_info['http_code']) && $curl_info['http_code'] === 0){
            $curl_error = curl_error($curl);
            $curl_error = !empty($curl_error) ? '[' . $curl_error .']' : '';
            throw new VimeoRequestException('Unable to complete request.' . $curl_error);
        }

        curl_close($curl);

        // Retrieve the info
        $header_size = $curl_info['header_size'];
        $headers = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        // Return it raw.
        return array(
            'body' => $body,
            'status' => $curl_info['http_code'],
            'headers' => self::parse_headers($headers)
        );

    }

    /**
     * Convert the raw headers string into an associated array
     *
     * @param string $headers
     * @return array
     */
    public static function parse_headers($headers)
    {
        $final_headers = array();
        $list = explode("\n", trim($headers));

        $http = array_shift($list);

        foreach ($list as $header) {
            $parts = explode(':', $header);
            $final_headers[trim($parts[0])] = isset($parts[1]) ? trim($parts[1]) : '';
        }

        return $final_headers;
    }


}

class VimeoAPIException extends Exception {}