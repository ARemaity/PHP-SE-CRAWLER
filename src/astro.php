<?php

declare(strict_types=1);

namespace src;
require_once '../load-env.php';
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Node\HtmlNode;
use PHPHtmlParser\Dom\Tag;
use PHPHtmlParser\Selector\Parser;
use PHPHtmlParser\Selector\Selector;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
/**
 * Class astro
 */
class astro 
{
   

    /**
     * @var ClientFactory
     */
    private $clientFactory;

    public function __construct(

    ) {

        $this->clientFactory = new \GuzzleHttp\Client();
    }

    private function getClient()
    {
        return $this->clientFactory;
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    public function doRequest(
        string $uriEndpoint,
        array $params = []
    ){
        /** @var Client $client */
        $client = $this->getClient();

        try {
            $response =$client->get(
                $uriEndpoint
            );
        } catch (GuzzleException $exception) {


            /** @var Response $response */
            $status = 400;
            $headers = [];
            $body = null;
            $version = '1.1';
            $reason = $exception->getMessage();
            $response = new \GuzzleHttp\Psr7\Response($status, $headers, $body, $version,$reason);
        }

        return $response;
    }

    
    /**
     * parseHtml : parse using  PHPHtmlParser package
     *
     * @param  string  $html
     * @return object
     */
    function parseHtml($html)
    {
        $dom = new \PHPHtmlParser\Dom;
        return $dom->loadStr($html);
    }
}
