<?php
interface user_events_Core_View_PibaseViewInterface {
	public function __construct(tslib_pibase $plugin);

	public function setViewConf(array $conf);

	public function render();
}
?>