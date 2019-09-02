<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Email_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		// $this->load->view('email/email_list_view');
		echo 'im here';
	}
	public function view(){
		$this->load->view('templates/header2');
		// $query['data'] = $this->db->query('select * from soa_notification where due_date 
		// 									IN(select due_date from soa_notification group by due_date having count(*) > 1) 
		// 									AND due_date = CURDATE() AND
		// 									balance != balance * 100 / balance')->result_array();
		$query['data'] = $this->db->query('SELECT * FROM soa_notification WHERE due_date = curdate()')->result_array();
		$result = $query['data'];
		// print_r($result);
		// echo '<pre>';
		print_r($query);
		// echo '<pre>';
		$this->load->view('email/email_list_view', $query);
		// echo json_encode($query);
	}

	public function message(){
		// $query = $this->db->query('SELECT * FROM soa_notification where due_date = curdate()')->result_array();
		// print_r($query);
		// foreach ($query as $value) {
		// 	$invoice_no = $value['invoice_no'];
		// 	// print_r($invoice_no);
		// }

		// $group = array();
		// foreach ($query as $val) {
		// 	$group[$val['client_id']][] = $val;
		// }
		// // print_r($group);
		// foreach ($group as $value) {
		// 	echo '<pre>';
		// 	echo $value[1]['invoice_no'];
		// 	echo $value[0]['client_name'];
		// }

		$query = $this->db->query('SELECT * FROM soa_notification')->result_array();
		foreach ($query as $data) {
			// $invoice_no = $data['invoice_no'];
			// $currency_code = $data['cureency_code'];
			$client_name = $data['client_name'];
			$client_email = $data['client_email'];
			$data = $data['due_date'];
			// print_r($client_name);
		}

		// switch ($data) {
		// 	case $data == date('y-m-d', strtotime('+ 7 days')):
		// 		$msg_id = 4;
		// 		$subject = 'AMTI SOA' .$client_name. 'NOT YET DUE INVOICES';
		// 		break;
		// 	case $data == date('y-m-d');
		// 		$msg_id = 5;
		// 		$subject = 'AMTI SOA' .$client_name. 'DUE INVOICES';
		// 		break;
		// 	case $data == date('y-m-d', strtotime('- 2 days'));
		// 		$msg_id = 6;
		// 		$subject = 'AMTI SOA' .$client_name. 'OVERDUE INVOICES';
		// 		break;
		// 	default:
		// 		$msg_id = 7;
		// 		$subject = 'AMTI SOA' .$client_name. 'OVERDUE INVOICES';
		// 		break;
		// }

		// $a_email = preg_replace('/\s+/', '', $client_email);
  //       $e_list = explode(',', $a_email);


        $client_email = 'flippinkip@gmail.com';


		// $where = $this->db->where(array('id' => $msg_id, 'active' => 1));
		// $data = $this->db->query('select * from lu_email_msg where id = 8 and active = 1')->result_array();
			// print_r($data);
		foreach ($data as $value) {
			echo $value['message'];
		}

		if (count($data) > 0) {
			$msg = $data[0]['message'];
			// echo $msg;
		}else{
			return;
		}

		if ($client_email == null || $client_email == '') {
			return;
		}else{
			$this->load->library('phpmailer_lib');
        
	        // PHPMailer object
	        $mail = $this->phpmailer_lib->load();
	        // print_r($mail);
	        
	        // SMTP configuration
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	        )
	        );
	        $mail->isSMTP();
	        $mail->Host     = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'flippinskip@gmail.com';
	        $mail->Password = 'Sucker11';
	        $mail->SMTPSecure = 'tls';
	        $mail->Port     = 587;
	        $mail->isHTML(true);
	        
	        $mail->setFrom('info@example.com', 'CodexWorld');
	        $mail->addReplyTo('info@example.com', 'CodexWorld');
	        
	        // Add a recipient
	        $mail->addAddress($client_email);
	        
	        
	        // Email subject
	        $mail->Subject = $subject;
	        
	        
	        // Email body content
	        $mailContent = '<div>Greetings!</div>
			                <br><br>
			                <div>The Invoice/s below is/are due in the next of days that have an outstanding balance of (total balance) AMTI SOA '.$client_name.' NOT YET DUE INVOICES. <br>
			                Please notify us immediately if there are any problems with the invoice/s in question and let us know when payment will be processed</div>
			                <br>
			                <table border=1 cellspacing=0 cellpadding=1>
			                                    <tr>
			                                      <td>Invoice Date</td>
			                                      <td>Invoice Number</td>
			                                      <td>PO Number</td>
			                                      <td>Currency</td>
			                                      <td>Invoice Amount</td>
			                                      <td>Balance</td>
			                                      <td>Due Date</td>
			                                    </tr>

			                                    <tr>
			                                      <td>'.date('m-d-Y', strtotime($value['invoice_date'])).'</td>
			                                      <td>'.$invoice_no.'</td>
			                                      <td>'.$po_number.'</td>
			                                      <td>'.$invoice_cur.'</td>
			                                      <td style="text-align:right;">54445</td>
			                                      <td style="text-align:right;">'.$balance.'</td>
			                                      <td>'.$due_date.'</td>
			                                    </tr>
			                                     <tr>
			                                    <td>Gtotal</td>
			                                    <td></td>
			                                    <td></td>
			                                    <td></td>
			                                    <td>Gtotal</td>
			                                    <td>Gtotal</td>
			                                    <td></td>
			                                    </tr>
			                                </table>
			                <br>
			                <div>You can contact us at (02)'.' '.$tele_phone.' or '.$tele_name.' (Telecollector) at (02)'.' '.$tele_phone.' loc.'.' '.$tele_local.' or email us at '.$tele_email.'</div>
			                <br>
			                <div>Kindly disregard this notice if payment has been processed.</div>
			                <br>
			                <div>Thank you for your business and we look forward to serving your future needs.</div>
			                <br>
			                <div>Sincerely,</div>
			                <br>
			                <div>Credit and Collection Department</div>
			                <div>Accent Micro Technologies, Inc.</div>
			                <br>
			                <br>
			                <div>"This a computer-generated document. No signature is required."</div>';

	        $mail->Body = $mailContent;
	        echo $mail->body;
		}
	}

	// public function get_total_balance($si_no){
 //      $balance_total = 0;
 //      $this->oracle_ar = $this->load->database('oracle_ar', true);
 //      $query_string = " select
 //                          SUM( abs(arp.AMOUNT_DUE_ORIGINAL) ) AS BALANCE 
 //                        FROM
 //                          AR_PAYMENT_SCHEDULES_ALL arp
 //                        WHERE
 //                          arp.TRX_NUMBER ='".$si_no."'
 //                      ";
 //      $search_result = $this->oracle_ar->query($query_string)->result_array();

 //      if(count($search_result)>0){
 //        $balance_total = $search_result[0]['BALANCE'];
 //      }
 //    return $balance_total;
 //    }

	public function soa_group(){
		$query = $this->db->query('SELECT * FROM soa_notification_group WHERE due_date = "2019-07-04"')->result_array();
		print_r($query);
	}


	public function send_email(){
    $query_string = "SELECT * FROM soa_notification  WHERE due_date = adddate(curdate(), + 7)";
    $result = $this->db->query($query_string)->result_array();

    // print_r($result);
    	
    	$group = array();    
        foreach ($result as $value) {
        	$group[$value['client_id']][] = $value;
        	$client_name = $value['client_name'];
        	// $balance = $value['balance'];
        	// $po_no = $value['po_no'];
        	// $due_date = $value['due_date'];
        	$invoice_date = $value['invoice_date'];
        	// $invoice_no = $value['invoice_no'];
        	$currency = $value['invoice_currency'];
        	$tele_name = $value['tele_name'];
        	$tele_phone = $value['tele_phone'];
        	$tele_local = $value['tele_local'];
        	$tele_email = $value['tele_email'];
        	// echo '<pre>';
        	// print_r($balance);
     	}

     	print_r($group);
     	$invoice_amount_grand_total = 0;
     	$balance_grand_total        = 0;

    	$tr_content ='';

     	foreach ($group as $key => $value) {
        	// $client_name = $value[0]['client_name'];
        	$balance = $value[0]['balance'];
        	$invoice_no = $value[0]['invoice_no'];
        	$po_no = $value[0]['po_no'];
        	$due_date = $value[0]['due_date'];


       //  	echo '<pre>';
     		// print_r($balance);

          //Condition if invoice_type_name no invoice in string
          // $row_po_no = '-';
          // if (strpos(strtolower($value['invoice_type_name']), 'invoice') !== false) {
          //   $row_po_no = $value['po_no'];
          // }

          $row_data  = '<tr>
                          <td>'. date("m-d-Y", strtotime($invoice_date)) .'</td>
                          <td>'.$invoice_no.'</td>
                          <td>'.$po_no.'</td>
                          <td>'.$currency.'</td>
                          <td style="text-align:right;">'.number_format($balance,2).'</td>
                          <td style="text-align:right;">'.number_format($balance,2).'</td>
                          <td>'. date("m-d-Y", strtotime($due_date)) .'</td>
                         </tr>';
 
   
        $invoice_amount_grand_total = $invoice_amount_grand_total + $balance;
        $balance_grand_total        = $balance_grand_total + $balance ;

        $tr_content = $tr_content . $row_data;

        $table_hdr = '<table border=1 cellspacing=0 cellpadding=1>
                          <tr>
                            <td>Invoice Date</td>
                            <td>Invoice Number</td>
                            <td>PO Number</td>
                            <td>Currency</td>
                            <td>Invoice Amount</td>
                            <td>Balance</td>
                            <td>Due Date</td>
                          </tr>';

        $table_footer = ' <tr>
                            <td>GTOTAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align:right;">'. number_format($invoice_amount_grand_total,2) .'</td>
                            <td style="text-align:right;">'. number_format($balance_grand_total,2) .'</td>
                            <td></td>
                          </tr>
                      </table>';


         $table_content = $table_hdr . $tr_content . $table_footer;


         // echo $table_content;

    $subject = 'AMTI SOA '.$client_name.' NOT YET DUE INVOICES';
    
    $message = '<div>Greetings!</div>'.$client_name.'  			              
			    <br><br>
               <div>The Invoice/s below is/are due in the next of days that have an outstanding balance of ( '.$currency.' ' .$balance_grand_total.' )  <br>
               Please notify us immediately if there are any problems with the invoice/s in question and let us know when payment will be processed</div>
               <br>
                '

                     .$table_content.
                   
                '
                </table>
                <br>
                <div>You can contact us at (02)'.' '.$tele_phone.' or '.$tele_name.' (Telecollector) at (02)'.' '.$tele_phone.' loc.'.' '.$tele_local.' or email us at '.$tele_email.'</div>
                <br>
                <div>Kindly disregard this notice if payment has been processed.</div>
                <br>
                <div>Thank you for your business and we look forward to serving your future needs.</div>
                <br>
                <div>Sincerely,</div>
                <br>
                <div>Credit and Collection Department</div>
                <div>Accent Micro Technologies, Inc.</div>
                <br>
                <br>
                <div>"This a computer-generated document. No signature is required."</div>';

                echo $message;

      }
      echo '<pre>';
     		print_r($balance);
  
     $client_email = '';

    if ($client_email == null || $client_email == '') {
      echo 'no email';
      return;
    }else{
	    $this->load->library('phpmailer_lib');

	    $mail = $this->phpmailer_lib->load();
	    // print_r($mail);
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	          )
	        );
	        $mail->isSMTP();
	        $mail->protocol = 'smtp';
	        $mail->Host     = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'flippinskip@gmail.com';
	        $mail->Password = 'Sucker11';
	        $mail->SMTPSecure = 'tls';
	        $mail->Port     = 587;

	        $mail->setFrom('noreply@amti.com.ph', 'Credit and Collections (AMTI)');
	        $mail->addReplyTo('noreply@amti.com.ph', 'Credit and Collections (AMTI)');
	        
	        // Add a recipient
	        $mail->addAddress($client_email);
	        
	        // Add cc or bcc 
	        // $mail->addCC('cc@example.com');
	        // $mail->addBCC('bcc@example.com');
	        
	        // Email subject
	        $mail->Subject = $subject;
	        
	        // Set email format to HTML
	        $mail->isHTML(true);
	        
	        // Email body content

	        $mailContent = $message;
	        $mail->Body = $mailContent;

	        //$mail->send();
	        
	        // Send email
	        if(!$mail->send()){
	            echo 'Message could not be sent.';
	            echo 'Mailer Error: ' . $mail->ErrorInfo;
	        }else{
	            self::track_email($row_invoice_no, $client_name, $client_email);
	    }
    }
   }
// }


	public function track_email($invoice_no, $client_name, $client_email){
		$record = array(
					'invoice_no' => $invoice_no,
					'client_name' => $client_name,
					'client_email' => $client_email,
					'sent_date' => date('y-m-d')
					);
		$this->db->insert('soa_track_email', $record);
	} 

	 public function get_total_balance($invoice_no){
      $balance_total = 0;
      $this->oracle_ar = $this->load->database('oracle_ar', true);
      $query_string = "select
                          SUM( abs(arp.AMOUNT_DUE_ORIGINAL) ) AS BALANCE 
                        FROM
                          AR_PAYMENT_SCHEDULES_ALL arp
                        WHERE
                          arp.TRX_NUMBER = '".$invoice_no."'";
                      
      $search_result = $this->oracle_ar->query($query_string)->result_array();

      if(count($search_result)>0){
        $balance_total = $search_result[0]['BALANCE'];
      }
      // echo $balance_total;
    return $balance_total;
    }

    public function group_si($client_id){
    	$query = $this->db->query('SELECT * FROM soa_notification where client_id = '.$client_id.' ')->result_array();
	    $group = array();
	    foreach ($query as  $value) {
	      $group[$value['client_id']][] = $value;
	    }
	    // print_r($group);

	    $new_group = array();
	    foreach ($group as $key => $value) {
	    	$new_group = $value;
	    	foreach ($new_group as $key => $value) {
	    		$invoice_list = $value['balance'];
	    	}
	    }
	   return $invoice_list;
    }

     public function get_current_balance($invoice_no){
      $result = 0;
      $total_balance = self::get_total_balance($invoice_no);
      $total_paid    = self::get_total_paid($invoice_no);

      $result = floatval($total_balance) - floatval($total_paid);

    return $result;
    }

     public function get_total_paid($invoice_no){
      $paid_total = 0;

      $search_result = self::get_payment_data(self::get_payment_sched_ids($invoice_no));
      if(count($search_result)>0){
        foreach ($search_result as $key => $value) {
          $paid_total = $paid_total + $search_result[$key]['PAYMENT_AMOUNT'];
        }
      }
    return $paid_total;
    }

    public function get_payment_data($payment_sched_ids = array() ){
      $payment_data=array();
      $this->oracle_ar = $this->load->database('oracle_ar', true);
      $query_string = " select
                          DISTINCT (cra.RECEIPT_NUMBER),
                          ara.AMOUNT_APPLIED as payment_amount,
                          cra.CREATION_DATE as payment_date,
                          cra.CURRENCY_CODE
                        FROM
                          AR_RECEIVABLE_APPLICATIONS_ALL ara 
                          left JOIN ar_cash_receipts_all cra ON ara.CASH_RECEIPT_ID=cra.CASH_RECEIPT_ID
                        WHERE
                          ara.APPLIED_PAYMENT_SCHEDULE_ID IN (".implode(',',$payment_sched_ids).")
                      ";
      $search_result = $this->oracle_ar->query($query_string)->result_array();

      if(count($search_result)>0){
        $payment_data = $search_result;
      }

      // echo "<pre>";
      // var_dump($search_result);die();
      return $payment_data;
    }

     public function get_payment_sched_ids($invoice_no){
      $ids=array();
      $this->oracle_ar = $this->load->database('oracle_ar', true);
      $query_string = " select
                          arp.PAYMENT_SCHEDULE_ID
                        FROM
                          AR_PAYMENT_SCHEDULES_ALL arp
                        WHERE
                          arp.TRX_NUMBER = '".$invoice_no."'  
                      ";
      $search_result = $this->oracle_ar->query($query_string)->result_array();

      if(count($search_result)>0){
        foreach ($search_result as $key => $value) {
          array_push($ids,  $value['PAYMENT_SCHEDULE_ID']);
        }
      }
      return $ids;
    }

    public function group(){
    set_time_limit(0);
	$query = $this->db->query('select * from soa_notif where days_overdue > 3');
	$result = $query->result_array();

	// $adata = array();
	// foreach($result as $key){
	// 	$adata[] = $key['client_id'];
	// }
	// // print_r($result);
	// $sampe = array_unique($adata);
	// // print_r($sampe);
	// $qwer = array();
	// foreach ($sampe as $key => $value) {
	// 	$newval = '';
	// 	foreach ($result as $newkey => $value2) {
	// 		if($value === $value2['client_id']) {
	// 			$newval += $value2['balance'];
	// 		}
	// 	}
	// 	$qwer[$value][] = $newval;		
	// }
	// print_r($qwer);

	// foreach ($qwer as $key => $value) {
	// 	print_r($value);
	// }

		$curr = array();
		foreach ($result as $key => $value) {
			$curr[$value['invoice_currency']][] = $value;

		}
		// print_r($group);

		$group = array();
		foreach ($curr as $key => $value) {
			$group[$value[0]['client_id']][] = $value;
		}

		print_r($group);
			foreach ($group as $val) {
				$query_string = $this->db->query('select message from lu_email_msg where id = 4')->row_array();
				$mail_msg = $query_string['message'];
				$tr_content = '';
				foreach ($val as $key => $value) {
				// print_r($value);
					$client_email = 'pol.kharlo.villa@gmail.com';
					$client_name = $value[0]['client_name'];
					$tele_phone = $value[0]['tele_phone'];
					$tele_local = $value[0]['tele_local'];
					$tele_email = $value[0]['tele_email'];
					$tele_name = $value[0]['tele_name'];
					$bal = $value[0]['balance'];
					$invoice_date = $value[0]['invoice_date'];
					// $po_no = $value['po_no'];
					$due_date = $value[0]['due_date'];
					$invoice_no  = $value[0]['invoice_no'];
					$currency = $value[0]['invoice_currency'];

					$po_no = '-';
		          if (strpos(strtolower($value[0]['invoice_type_name']), 'invoice') !== false) {
		            $po_no = $value[0]['po_no'];
		          }

				$tr_content .= ' <tr>
			                                      <td style="padding:5px;">'.date('m-d-Y', strtotime($invoice_date)).'</td>
			                                      <td style="padding:5px;">'.$invoice_no.'</td>
			                                      <td style="padding:5px;">'.$po_no.'</td>
			                                      <td style="padding:5px;">'.$currency.'</td>
			                                      <td style="text-align:center; padding=5px;">54445</td>
			                                      <td style="text-align:center; padding=5px;">'.$bal.'</td>
			                                      <td style="padding:5px;">'.$due_date.'</td>
			                                    </tr>';
        		// print_r($client_email);
				}

				$t_header = '<table border=1 cellspacing=0 cellpadding=1>
			                                    <tr>
			                                      <td style="padding:5px;">Invoice Date</td>
			                                      <td style="padding:5px;">Invoice Number</td>
			                                      <td style="padding:5px;">PO Number</td>
			                                      <td style="padding:5px;">Currency</td>
			                                      <td style="padding:5px;">Invoice Amount</td>
			                                      <td style="padding:5px;">Balance</td>
			                                      <td style="padding:5px;">Due Date</td>
			                                    </tr>';
			    $t_footer = ' <tr>
			                                    <td style="padding:5px;">Gtotal</td>
			                                    <td style="padding:5px;"></td>
			                                    <td style="padding:5px;"></td>
			                                    <td style="padding:5px;"></td>
			                                    <td style="padding:5px;">Gtotal</td>
			                                    <td style="padding:5px;">Gtotal</td>
			                                    <td style="padding:5px;"></td>
			                                    </tr>
			                                </table>';
			    $table = $t_header . $tr_content . $t_footer;
				
				$subject = 'AMTI SOA '.$client_name.' NOT YET DUE INVOICES';

				$mail_msg = str_replace('tele_name', $tele_name, $mail_msg);
				$mali_msg = str_replace('tele_phone', $tele_phone, $mail_msg);
				$mail_msg = str_replace('tele_local', $tele_local, $mail_msg);
				$mail_msg = str_replace('tele_email', $tele_email, $mail_msg);
				$mail_msg = str_replace('tele_phone', $tele_phone, $mail_msg);
				$mail_msg = str_replace('table', $table, $mail_msg);
				$mail_msg = str_replace( '[' , ''  , $mail_msg);
        		$mail_msg = str_replace( ']' , ''  , $mail_msg);

        		// print_r($mail_msg);

      //   	$client_email = 'pol.kharlo.villa@gmail.com';

		//     if ($client_email == null || $client_email == '') {
		//       echo 'no email';
		//       return;
		//     }else{
		//     $this->load->library('phpmailer_lib');

		//     $mail = $this->phpmailer_lib->load();
		//     // print_r($mail);
		//         $mail->SMTPOptions = array(
		//             'ssl' => array(
		//             'verify_peer' => false,
		//             'verify_peer_name' => false,
		//             'allow_self_signed' => true
		//           )
		//         );
		//         $mail->isSMTP();
		//         $mail->protocol = 'smtp';
		//         $mail->Host     = 'smtp.gmail.com';
		//         $mail->SMTPAuth = true;
		//         $mail->Username = 'flippinskip@gmail.com';
		//         $mail->Password = 'Sucker11';
		//         $mail->SMTPSecure = 'tls';
		//         $mail->Port     = 587;

		//         $mail->setFrom('noreply@amti.com.ph', 'Credit and Collections (AMTI)');
		//         // $mail->addReplyTo('noreply@amti.com.ph', 'Credit and 'pol.kharlo.villa@gmail.com'		        // 
		//         // Add a recipient
		//         $mail->addAddress($client_email);
		        
		//         // Add cc or bcc 
		//         // $mail->addCC('cc@example.com');
		//         // $mail->addBCC('bcc@example.com');
		        
		//         // Email subject
		//         $mail->Subject = $subject;
		        
		//         // Set email format to HTML
		//         $mail->isHTML(true);
		        
		//         // Email body content

		//         $mailContent = $mail_msg;
		//         $mail->Body = $mailContent;

		//         //$mail->send();
		        
		//         // Send email
		//         if(!$mail->send()){
		//             echo 'Message could not be sent.';
		//             echo 'Mailer Error: ' . $mail->ErrorInfo;
		//         }else{
		//             // echo 'Message has been sent';
		//             self::track_email($invoice_no, $client_name, $client_email);
		//         }
		//         }
		}		
    }

    public function select_group(){
    	$query = $this->db->query('SELECT DISTINCT(soa.invoice_no),(gru.client_id),(gru.group_id),(soa.client_name),(soa.due_date) FROM soa_notification soa INNER JOIN soa_notification_group gru WHERE soa.due_date = ADDDATE(CURDATE(), - 2)')->result_array();							
    	foreach ($query as $key => $value) {
    		$id = $value['group_id'];
    		$invoice = $value['invoice_no'];
    		$name = $value['client_name'];
    		echo "<pre>";
  			print_r($id." ".$invoice." ".$name);	
    	}
    }

 	public function msg(){
 		$query = "select * from lu_email_msg where id = 4";
 		$result = $this->db->query($query)->result_array();

 		echo $result[0]['message'];
 		// foreach ($result as $key => $value) {
 		// 	if (count($value)>0) {
 		// 		print_r($value['message']);
 		// 	}
 		// }
 	}
}