<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Extend the tl_settings palettes
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{amzn_legend:hide},amzn_API_KEY,amzn_API_SECRET_KEY,amzn_ASSOCIATE_TAGS;';


/**
* Add fields to tl_settings
*/
$GLOBALS['TL_DCA']['tl_settings']['fields']['amzn_API_KEY'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_settings']['amzn_API_KEY'], 
    'inputType'	=> 'text',
    'exclude'	=> true,
    'eval'	=> array(
        'mandatory'     => false, 
        'rgxp'          => 'alnum',
        'tl_class'      => 'w50',
    ),
    'sql'	=>	"varchar(255) NOT NULL default ''",
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['amzn_API_SECRET_KEY'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_settings']['amzn_API_SECRET_KEY'],
    'inputType'	=> 'text',
    'exclude'	=> true,
    'eval'	=> array(
        'mandatory'     => false,
        'unique'        => false,
        'maxlength'     => 255,
        'tl_class'      => 'w50',
    ),
    'sql'	=>	"varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_settings']['fields']['amzn_ASSOCIATE_TAGS'] = array(
    'label'     => $GLOBALS['TL_LANG']['tl_settings']['amzn_ASSOCIATE_TAGS'],
    'inputType'	=> 'text',
    'exclude'	=> true,
    'eval'	=> array(
        'mandatory'     => false,
        'unique'        => false,
        'maxlength'     => 255,
        'tl_class'      => 'w50',
    ),
    'sql'	=>	"varchar(255) NOT NULL default ''"
);
