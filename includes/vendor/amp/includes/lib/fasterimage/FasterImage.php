<?php namespace FasterImage;

use FasterImage\Exception\InvalidImageException;
use WillWashburn\Stream\Exception\StreamBufferTooSmallException;
use WillWashburn\Stream\Stream;
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * FasterImage - Because sometimes you just want the size, and you want them in
 * parallel!
 *
 * Based on the PHP stream implementation by Tom Moor (http://tommoor.com)
 * which was based on the original Ruby Implementation by Steven Sykes
 * (https://github.com/sdsykes/fastimage)
 *
 * MIT Licensed
 *
 * @version 0.01
 */
class FasterImage
{
    /**
     * The default timeout
     *
     * @var int
     */
    protected $timeout = 10;

    /**
     * Get the size of each of the urls in a list
     *
     * @param array $urls
     *
     * @return array
     * @throws \Exception
     */
    public function batch(array $urls)
    {

       
        $results          = [];
        $request          = array();
        foreach ( array_values($urls) as $count => $uri ) {
            if ( 0 === strpos( $uri, 'http' ) || 0 === strpos( $uri, 'https' )) {
                $results[$uri] = array();
                $request[$uri] = array(
                    'url' =>  $uri,
                    'type' => 'GET',
                );
            }
        }
        $options= array(
                    'timeout'=>$this->timeout,
                    'connect_timeout'=>$this->timeout,
                    'useragent'=>'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36',
                    'verify'=> 1,
                    'verifyname'=>1,
                    'follow_redirects'=>true,
                    'complete'=> function($response, $url) use(&$results){
                        $stream           = new Stream();
                        $parser           = new ImageParser($stream);
                        $results[$url]['rounds'] = 0;
                        $results[$url]['bytes']  = 0;
                        $results[$url]['size']   = 'failed';
                        if( is_a( $response, 'Requests_Response' ) ){
                            $str = $response->body;
                            $results[$url]['bytes'] += strlen($str);
                            $results[$url]['rounds']++;
                            $stream->write($str);
                            try {
                                    // store the type in the result array by looking at the bits
                                     $results[$url]['type'] = $parser->parseType();
                                     $results[$url]['size'] = $parser->parseSize() ?: 'failed';
                                }
                                catch (StreamBufferTooSmallException $e) {
                                    $results[$url]['size'] = 'failed';
                                    return strlen($str);
                                }
                                catch (InvalidImageException $e) {
                                    $results[$url]['size'] = 'invalid';
                                    return -1;
                                }
                                 return -1;
                        }
                    }
        );

        if ( ! defined( 'REQUESTS_SILENCE_PSR0_DEPRECATIONS' ) ) {
            define( 'REQUESTS_SILENCE_PSR0_DEPRECATIONS', true );
        }
        if( class_exists('Requests') ){
            $responseResults = \Requests::request_multiple($request , $options);
        }
        return $results;
    }

    /**
     * @param $seconds
     */
    public function setTimeout($seconds)
    {
        $this->timeout = $seconds;
    }

    
}
