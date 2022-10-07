<?php

declare(strict_types=1);

namespace api;
require_once 'astro.php';
use api\astro;


/**
 * Class Tecdoc
 */
class astroMethods extends astro
{

    public $domain;
    public $full_url;
    private function execute(
        $params = []
    ): string {
        $response = $this->doRequest($this->full_url, $params);
        $status = $response->getStatusCode();
        $responseBody = $response->getBody();
        $responseContent = $responseBody->getContents();
        return $responseContent;
    }
    
    /**
     * setEngine : set the engine domain
     *
     * @param  string $domainInput
     * @return void
     */
    public function setEngine($domainInput)
    {
        $this->domain = $domainInput;
    }

      
    /**
     * search : search according to array of keywords
     *
     * @param  array $keywords
     * @return void
     */
    public function search($keywords)
    {
        
       $returns=array();
       $ranking=0;
       $searched=implode(" ", $keywords);
        if($this->domain&&sizeof($keywords)>0){
            $this->full_url = sprintf($_ENV['SEARCH_URL'], $this->domain,implode("+", $keywords) );
            $result = $this->execute($keywords);
            $html = $this->parseHtml($result);
       
            foreach ($html->find('div#main > div') as $element){
                $check_title="";
                $check_link="";
                $check_span="";
         
                $check_title=$element->find('span');
                if(count($check_title)){
                    $check_title=$check_title->text;
                }

                $check_link=$element->find('a');
                if(count($check_link)){
                    $check_link=str_replace('/url?q=', '', $check_link->href);
                }
                $check_desc=$element->find('div > div',1);
                if($check_desc){
                    $check_span=$check_desc->find('span');
                    if(count($check_span)){
                        $check_span=$check_span->text; 
                    }
                }
                $returns[]=array(
                    "keyword"=>$searched,
                    "ranking"=> $ranking,
                    "url"=>$check_link,
                    "title"=>$check_title,
                    "description"=>$check_span

                );
                
                $ranking++;
            }
           return $returns;
          
        }
   
       

      
    }

}
