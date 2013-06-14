<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$TCA['user_events_events'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY eventdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/TCA.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/tca-events.gif',
	),
);

$TCA['user_events_categories'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_categories',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/TCA.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/tca-categories.gif',
	),
);


t3lib_div::loadTCA('tt_content');
//$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_EventController'] = 'layout,select_key,pages,recursive';

// enable flexform functionality
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_EventController']='pi_flexform';

// add flexform XML
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_EventController', 'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexform/Event.xml');

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:user_events/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_EventController',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE === 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['user_events_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'Classes/Utility/ContentElementWizard.php';
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/Static/', 'Eventcalendar');
?>