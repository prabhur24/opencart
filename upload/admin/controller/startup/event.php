<?php
namespace Application\Controller\Startup;
class Event extends \System\Engine\Controller {
	public function index() {
		// Add events from the DB
		$this->load->model('setting/event');
		
		$results = $this->model_setting_event->getEvents();
		
		foreach ($results as $result) {
			if ((substr($result['trigger'], 0, 6) == 'admin/') && $result['status']) {
				$this->event->register(substr($result['trigger'], 6), new \System\Engine\Action($result['action']), $result['sort_order']);
			}
		}		
	}
}