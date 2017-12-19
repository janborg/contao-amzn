<?php

/* 
 * 
 */

/*
 * Paletten
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['amzn_productbox'] = '{type_legend},type,headline;{amzn_legend},amzn_ASIN,amzn_ASSOCIATE_TAG,amzn_IMAGESIZE';

/*
 * Felder
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['amzn_ASIN'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_content']['amzn_ASIN'], 
    'inputType'	=> 'text',
    'exclude'	=> true,
    'eval'	=> array(
        'mandatory'     => true, 
        'rgxp'          => 'alnum',
        'tl_class'      => 'w50',
    ),
    'sql'	=>	"varchar(255) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_content']['fields']['amzn_ASSOCIATE_TAG'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_content']['amzn_ASSOCIATE_TAG'],
    'inputType'	=> 'select',
    'options_callback'  => array('amznContent','getAssociateTags'),
    'exclude'	=> true,
    'filter'    => true,
    'eval'	=> array(
        'mandatory'     => true,
        'unique'        => false,
        'maxlength'     => 255,
        'tl_class'      => 'w50',
		'submitOnChange'=> true,
		'alwaysSave'	=> true,
	),
    'sql'	=>	"varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['amzn_IMAGESIZE'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_content']['amzn_IMAGESIZE'],
    'inputType'	=> 'select',
    'exclude'	=> true,
    'eval'	=> array(
        'mandatory'     => true,
        'chosen'        => true,
        'tl_class'      => 'w50',
        'includeBlankOption'    => false,
    ),
    'options'   => array (
        'SmallImage',
        'TinyImage',
        'MediumImage',
        'LargeImage',
        'HiResImage',
    ),
    'sql'	=>	"varchar(255) NOT NULL default ''"
);

class amznContent extends Backend{
    public function getAssociateTags(){
        
		$arrTags = explode(',', $GLOBALS['TL_CONFIG']['amzn_ASSOCIATE_TAGS']);
        
        return $arrTags;
    }
}

