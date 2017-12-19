<?php

/* 
 * Copyright (C) 2017 Janborg
 *
 */

namespace Janborg\AmznPai\Elements;
use ApaiIO\ApaiIO;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Lookup;
use Contao\ContentElement;

/**
 * Class ContentAmznProductBox
 *
 * @author Janborg
 */

class ContentAmznProductBox extends \ContentElement{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_amzn_productbox';
    /**
     * Generate the module
     */
    protected function compile(){
    
        if (TL_MODE == 'BE') {
            $this->genBeOutput();
        } else {
            $this->genFeOutput();
        }
    }
 
    /**
     * Erzeugt die Ausgebe für das Backend.
     * @return string
     */
    private function genBeOutput()
    {
        $this->strTemplate          = 'be_wildcard';
        $this->Template             = new \BackendTemplate($this->strTemplate);
        $this->Template->title      = $this->headline;
        $this->Template->wildcard   = "Amazon Produkt ASIN: ".$this->amzn_ASIN.", TAG: ".$this->amzn_ASSOCIATE_TAG;
    }
    /**
     * Erzeugt die Ausgabe für das Frontend.
     * @return string
     */
    private function genFeOutput()
    { 
    // Template ausgeben
        $this->Template = new \FrontendTemplate($this->strTemplate);
        $this->Template->class = "ce_amzn_article";

	//request erstellen und Response in Array umwandeln
            $conf = new GenericConfiguration();
            $client = new \GuzzleHttp\Client();
            $request = new \ApaiIO\Request\GuzzleRequest($client);

            try {
                $conf
                    ->setCountry('de')
                    ->setAccessKey($GLOBALS['TL_CONFIG']['amzn_API_KEY'])
                    ->setSecretKey($GLOBALS['TL_CONFIG']['amzn_API_SECRET_KEY'])
                    ->setAssociateTag($this->amzn_ASSOCIATE_TAG)
                    ->setRequest($request)
                    ->setResponseTransformer(new \ApaiIO\ResponseTransformer\XmlToArray());
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $apaiIO = new ApaiIO($conf);

            $lookup = new Lookup();
            $lookup->setItemId($this->amzn_ASIN);
            $lookup->setCondition('New');
			$lookup->setMerchantId('Amazon');
            $lookup->setResponseGroup(array('Images', 'Offers', 'ItemAttributes'));

            $formattedResponse = $apaiIO->runOperation($lookup);

	//Response an Template übergeben
            $this->Template->AMZN_TAG           = $this->amzn_ASSOCIATE_TAG;
            $this->Template->amzn_Imagesize     = $this->amzn_IMAGESIZE;
            $this->Template->ProductTitle		= $formattedResponse['Items']['Item']['ItemAttributes']['Title'];
            $this->Template->DetailPageUrl		= $formattedResponse['Items']['Item']['DetailPageURL'];
            $this->Template->Images				= $formattedResponse['Items']['Item']['ImageSets']['ImageSet'];
            $this->Template->Features           = $formattedResponse['Items']['Item']['ItemAttributes']['Feature'];
            $this->Template->ListPrice          = $formattedResponse['Items']['Item']['ItemAttributes']['ListPrice'];
            $this->Template->Offer              = $formattedResponse['Items']['Item']['Offers']['Offer'];

            $this->Template->arrResponse	= $formattedResponse;
    }
}
