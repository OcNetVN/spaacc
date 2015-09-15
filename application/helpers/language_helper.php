<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function change_language()
{
	
    $lang = "";

	if(isset($_POST['language'])){
	   $_SESSION['Lang'] = $_POST['language'];
	   $lang = $_SESSION['Lang'];
	}
	if(isset($_SESSION['Lang']))
	{
	  $lang = $_SESSION['Lang'];
	}
	else
	{
		// Get a reference to the controller object
		$CI = get_instance();

		// You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('m_mail');

		$_SESSION['Lang']=$CI->m_mail->getSetting("LangaugeDefault");

		$lang = $_SESSION['Lang'];
	}
	return $lang;
}

?>