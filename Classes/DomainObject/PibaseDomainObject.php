<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/DomainObject/DomainObjectInterface.php';

require_once t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxy.php';

abstract class user_events_DomainObject_PibaseDomainObject extends user_events_Utility_PibaseMethodsProxy implements user_events_DomainObject_DomainObjectInterface {

	abstract public function __construct(array $row);

	abstract public function __set($property, $value);

	abstract public function injectContentObject(tslib_cObj $cObj);
}
?>