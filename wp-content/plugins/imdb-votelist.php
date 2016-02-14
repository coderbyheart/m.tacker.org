<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once 'HTTP/Client.php';
    require_once 'HTTP/Request/Listener.php';

    class HTTP_Client_LinkChecker extends HTTP_Request_Listener
    {

        function update(&$subject, $event, $data)
        {
            echo '<pre>'; print_r(func_get_args()); echo '</pre>';
            switch ($event) {
                case 'httpSuccess':
                    if ('' == $this->_redirUrl) {
                        $this->_urls[$this->_checkedUrl] = 'OK';
                    } else {
                        $this->_urls[$this->_checkedUrl] = 'Moved to ' . $this->_redirUrl;
                    }
                    break;

                case 'httpError':
                    $response =& $subject->currentResponse();
                    $this->_urls[$this->_checkedUrl] = 'HTTP Error ' . $response['code'];
                    break;

                case 'httpRedirect':
                    $this->_redirUrl = $data;
                    break;

                case 'request':
                    $this->_checkedUrl = $data;
                    $this->_redirUrl   = '';
            }
        }
    }

    $url = 'http://www.imdb.com/mymovies/list';
    $url_login = 'http://www.imdb.com/register/login';

    $client  =& new HTTP_Client();
    $checker =& new HTTP_Client_LinkChecker();
    $client->attach($checker);

    $client->setRequestParameter(array('user' => 'kbvazrqgtvqolr@mailinator.com', 'pass' => 'qwerty'));
    $client->get($url_login);

    $client->setRequestParameter(array('l' => '17725346'));
    $client->get($url);

    // echo '<pre>'; var_dump($client->post($url)); echo '</pre>';

?>