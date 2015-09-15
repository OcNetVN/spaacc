<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
			$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => 'ssl://smtp.googlemail.com',
			      'smtp_port' => 465,
			      'smtp_user' => 'thuan.nguyenngockim@gmail.com',
			      'smtp_pass' => '08158291',
						'mailtype' => 'html'
			);
			
		
      
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Set to, from, message, etc.
			$this->email->to("thuan.nguyenngockim@gmail.com");
			$this->email->from("thuan.nguyenngockim@gmail.com","CodeRiddles Support");
			$this->email->bcc("thuan.nguyenngockim@gmail.com"); 
			$this->email->subject("Codeigniter email library Test");
			$this->email->message("<b>Codeigniter email Library</b> Body Content");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */