<?php

########################################################################
# Extension Manager/Repository config file for ext "user_events".
#
# Auto generated 13-09-2012 17:23
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Eventcalendar',
	'description' => 'Fügt der Webseite einen Veranstaltungskalender mit Listen- und Detailansicht hinzu.',
	'category' => 'plugin',
	'author' => 'Thomas Juhnke',
	'author_email' => 'tommy@van-tomas.de',
	'shy' => '',
	'dependencies' => 'tt_address',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_userevents/rte/',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'tt_address' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:45:{s:9:"ChangeLog";s:4:"110f";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"447e";s:14:"ext_tables.php";s:4:"1d96";s:14:"ext_tables.sql";s:4:"83ee";s:31:"icon_user_events_categories.gif";s:4:"1e24";s:27:"icon_user_events_events.gif";s:4:"4ad7";s:13:"locallang.xml";s:4:"376d";s:16:"locallang_db.xml";s:4:"9741";s:7:"tca.php";s:4:"6ded";s:13:"template.html";s:4:"a44d";s:39:"Classes/Model/DomainObjectInterface.php";s:4:"eecf";s:23:"Classes/Model/Event.php";s:4:"6951";s:31:"Classes/Model/EventCategory.php";s:4:"577a";s:41:"Classes/Model/EventCategoryRepository.php";s:4:"6cca";s:33:"Classes/Model/EventRepository.php";s:4:"22ae";s:36:"Classes/Model/PibaseDomainObject.php";s:4:"1861";s:34:"Classes/Model/PibaseRepository.php";s:4:"883a";s:37:"Classes/Model/RepositoryInterface.php";s:4:"5ae9";s:38:"Classes/Utility/PibaseMethodsProxy.php";s:4:"f049";s:47:"Classes/Utility/PibaseMethodsProxyInterface.php";s:4:"c9ff";s:32:"Classes/View/EventDetailView.php";s:4:"0d08";s:34:"Classes/View/EventListItemView.php";s:4:"551f";s:41:"Classes/View/EventListPageBrowserView.php";s:4:"4f4f";s:33:"Classes/View/EventListRowView.php";s:4:"70e7";s:40:"Classes/View/EventListSearchFormView.php";s:4:"6422";s:30:"Classes/View/EventListView.php";s:4:"37de";s:27:"Classes/View/MarkerView.php";s:4:"b4c8";s:36:"Classes/View/PibaseViewInterface.php";s:4:"eaa9";s:35:"Classes/View/StackedViewManager.php";s:4:"401e";s:28:"Classes/View/SubpartView.php";s:4:"b9fb";s:37:"Classes/View/ViewManagerInterface.php";s:4:"dac8";s:19:"doc/wizard_form.dat";s:4:"8edd";s:20:"doc/wizard_form.html";s:4:"5c08";s:14:"pi1/ce_wiz.gif";s:4:"02b6";s:29:"pi1/class.user_events_pi1.php";s:4:"ca56";s:37:"pi1/class.user_events_pi1_wizicon.php";s:4:"eced";s:13:"pi1/clear.gif";s:4:"cc11";s:19:"pi1/flexform_ds.xml";s:4:"a8e7";s:17:"pi1/locallang.xml";s:4:"2d2c";s:21:"res/external-link.gif";s:4:"bae6";s:17:"res/template.html";s:4:"0dba";s:34:"static/eventcalendar/constants.txt";s:4:"132d";s:30:"static/eventcalendar/setup.txt";s:4:"324d";}',
	'suggests' => array(
	),
);

?>