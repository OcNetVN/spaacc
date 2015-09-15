<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Notify extends CI_Controller
{
       function __construct()
       {
            parent::__construct();
            $this->load->model('m_checkout');
            $this->load->model('admin/m_user');
            $this->load->model('m_index');
            $this->load->model('m_mail');
       }
       
       public function index()
       {
			if(isset($_REQUEST['mTransactionID']))
			{
				$mTransactionID = $_REQUEST['mTransactionID'];
				$bankCode = $_REQUEST['bankCode'];
				$transactionStatus = $_REQUEST['transactionStatus'];
				$description = $_REQUEST['description'];
				$ts = $_REQUEST['ts'];
				$checksum = $_REQUEST['checksum'];
				$sMySecretkey = 'SPATHEBOOKINGVNoOAj5Aj8AN';//key use to hash checksum that will be provided by 123Pay
				$sRawMyCheckSum = $mTransactionID.$bankCode.$transactionStatus.$ts.$sMySecretkey;
				$sMyCheckSum = sha1($sRawMyCheckSum);
				
				if($sMyCheckSum != $checksum)
				{
					 $this->response($mTransactionID, '-1', $sMySecretkey);
				}
				$iCurrentTS = time();
				$iTotalSecond = $iCurrentTS - $ts;
				
				$processResult = $this->process($mTransactionID, $bankCode, $transactionStatus);
				$this->response($mTransactionID, $processResult, $sMySecretkey);
			}
       }
       public function process($mTransactionID, $bankCode, $transactionStatus)
        {
        	try
        	{
        		//do you update order status process
                $status=$this->m_checkout->statusbookingonline($mTransactionID,$transactionStatus);
                if ($status==1 || $status=='1')
        		  return 1;//if process successfully
                else
				{
					if ($status==2 || $status=='2')
					  return 2;//if process successfully
					else
						return -3;//if you have been received notify status before
				}
        	}
        	catch(Exception $_e)
        	{
        		return -3;	
        	}
        }
        public function response($mTransactionID, $returnCode, $key)
        {
        	$ts = time();
        	$sRawMyCheckSum = $mTransactionID.$returnCode.$ts.$key;
        	$checksum = sha1($sRawMyCheckSum);
        	$aData = array(
        		'mTransactionID' => $mTransactionID,
        		'returnCode' => $returnCode,
        		'ts' => time(),
        		'checksum' => $checksum
        	);
        	echo json_encode($aData);
        	exit;
        }
}
?>
