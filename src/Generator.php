<?php

namespace Webme\Url;

/**
 *     
 * 
 * Classe: Generator
 * 
 * @filesource Generator.php
 * @package webme-url-generator
 * @subpackage 
 * @category
 * @version v1.0
 * @since 10/02/2017 00:44:24
 * @copyright (cc) 2017, Fernando Petry
 * 
 * @author Fernando Petry <fernandosouza2@gmail.com>                                                  
 */
class Generator
{

    /**
     * Path base de onde deverá ser construido a url completa
     * @var string
     */
    private $pathBase;

    /**
     * Tipo de navegação = http ou https
     * @var string
     */
    private $http = 'http';

    /**
     * Método construtor
     * @param string $pathBase É o path base de onde se construira a url completa
     */
    public function __construct($pathBase) {
        $this->pathBase = $pathBase;
        $this->defineProtocol();
    }

    /**
     * Informa a classe que o tipo de navegação é HTTPS
     * @return \pcore\UrlCompleta
     */
    public function setSSL() {
        $this->http = 'https';
        return $this;
    }

    /**
     * Recupera o nome do servidor, por exemplo localhost
     */
    private function getServidorNome() {
        if (isset($_SERVER['SERVER_NAME']))
        {
            //$servidor = str_replace('\\', '/', $_SERVER['SERVER_NAME']);
//            $servidor = $_SERVER['SERVER_NAME'];
            $servidor = $_SERVER['HTTP_HOST'];
        }
        else
        {
            //$servidor = str_replace('\\', '/', gethostname());
            $servidor = gethostname();
        }

//        echo $servidor . PHP_EOL;
        //$servidor = str_replace('/', '', $servidor);
        return trim($servidor);
    }

    /**
     * Verifica o protocolo
     */
    private function defineProtocol() {
        $protocol = "http";
//        $https = filter_input(INPUT_SERVER, 'HTTPS');
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
        {
//        if (isset($https) && $https == 'on') {
            $protocol = "https";
        }
        $this->http = $protocol;
    }

    /**
     * Transforma o PATH em HTTP
     */
    private function getHTTP() {
        $http = $_SERVER['DOCUMENT_ROOT'];

        // se for verdadeiro, então estamos em um ambiente Windows
        if (substr($_SERVER['DOCUMENT_ROOT'], 1, 1) == ":")
        {
            $http = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']);
        }

        if (substr($http, -1) == '/')
        {
            $http = substr($http, 0, -1); // removendo barra do final se houver
        }
        if (substr($http, -1) == '\\')
        {
            $http = substr($http, 0, -1); // removendo barra do final se houver
        }
        $http = str_replace($http, $this->getServidorNome(), $this->pathBase);
        $http = str_replace('//', '/', $http);

        // segunda parte
        if (substr($http, -1) == '/')
        {
            $http = substr($http, 0, -1); // removendo barra do final
        }

        // invertendo as barras
        $http = str_replace('\\', '/', $http);
        return trim($http);
    }

    public function getURL() {
        return $this->http . '://' . $this->getHTTP();
    }

}
