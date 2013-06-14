<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.user_events_events=1
');
t3lib_extMgm::addPageTSConfig('

	# ***************************************************************************************
	# CONFIGURATION of RTE in table "user_events_events", field "bodytext"
	# ***************************************************************************************
RTE.config.user_events_events.bodytext {
  hidePStyleItems = H1, H4, H5, H6
  proc.exitHTMLparser_db=1
  proc.exitHTMLparser_db {
    keepNonMatchedTags=1
    tags.font.allowedAttribs= color
    tags.font.rmTagIfNoAttrib = 1
    tags.font.nesting = global
  }
}
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.user_events_categories=1
');

t3lib_extMgm::addPItoST43($_EXTKEY, 'Classes/Controller/EventController.php', '_EventController', 'list_type', 1);

// $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['user_events']['getEventRecordsHook'][] = 'user_events_'
?>