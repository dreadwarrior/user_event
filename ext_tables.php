<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
$TCA['user_events_events'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:user_events/locallang_db.xml:user_events_events',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'languageField'            => 'sys_language_uid',
		'transOrigPointerField'    => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'default_sortby' => 'ORDER BY eventdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_user_events_events.gif',
	),
);

$TCA['user_events_categories'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:user_events/locallang_db.xml:user_events_categories',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'default_sortby' => 'ORDER BY title',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_user_events_categories.gif',
	),
);


t3lib_div::loadTCA('tt_content');
//$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages,recursive';

// enable flexform functionality
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1']='pi_flexform';

// add flexform XML
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/pi1/flexform_ds.xml');

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:user_events/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE === 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['user_events_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.user_events_pi1_wizicon.php';
}

t3lib_extMgm::addStaticFile($_EXTKEY,'static/eventcalendar/', 'Eventcalendar');
?>