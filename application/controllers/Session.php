<?php
class Session extends CI_Controller
{
public function clear_flashdata() {
	echo 'OKEY';
	if ($this->session->userdata("message") ) {
		$this->session->unset_userdata('message');
	}
	$this->output->set_status_header(200);
}
}
