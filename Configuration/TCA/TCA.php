<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['user_events_events'] = array(
	'ctrl' => $TCA['user_events_events']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,starttime,endtime,fe_group,eventdate,title,subtitle,categories,location,shorttext,bodytext,image,alttext,titletext,links,documents'
	),
	'feInterface' => $TCA['user_events_events']['feInterface'],
	'columns' => array(
		't3ver_label' => array(
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'sys_language_uid' => array(
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table'       => 'user_events_events',
				'foreign_table_where' => 'AND user_events_events.pid=###CURRENT_PID### AND user_events_events.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough'
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'starttime' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'default'  => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config'  => array(
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0',
				'range'    => array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m')-1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config'  => array(
				'type'  => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'eventdate' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.eventdate',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'checkbox' => '0',
				'eval' => 'required,datetime',
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'subtitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.subtitle',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'categories' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.categories',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'user_events_categories',
				'foreign_table_where' => 'AND user_events_categories.pid=###STORAGE_PID### AND user_events_categories.sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY user_events_categories.uid',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
				"MM" => "user_events_events_categories_mm",
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'user_events_categories',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'user_events_categories',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
		'location' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.location',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tt_address',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'shorttext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.shorttext',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
			)
		),
		'bodytext' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.bodytext',
			'config' => array(
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/tx_userevents',
				'show_thumbs' => 1,
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'alttext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.alttext',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'titletext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.titletext',
			'config' => array(
				'type' => 'input',
				'size' => '30',
			)
		),
		'links' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.links',
			'config' => array(
				'type' => 'text',
				'wrap' => 'OFF',
				'cols' => '30',
				'rows' => '6',
			)
		),
		'documents' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_events.documents',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => '',
				'disallowed' => 'php,php3',
				'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
				'uploadfolder' => 'uploads/tx_userevents',
				'size' => 6,
				'minitems' => 0,
				'maxitems' => 6,
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, eventdate, title;;;;2-2-2, subtitle;;;;3-3-3, categories, location, shorttext, bodytext;;;richtext[]:rte_transform[mode=ts_css|imgpath=uploads/tx_userevents/rte/], image, alttext, titletext, links, documents')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);



$TCA['user_events_categories'] = array(
	'ctrl' => $TCA['user_events_categories']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['user_events_categories']['feInterface'],
	'columns' => array(
		't3ver_label' => array(
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'max'  => '30',
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:user_events/Resources/Private/Language/Tca.xml:user_events_categories.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>