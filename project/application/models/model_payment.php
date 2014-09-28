<?php 
	class model_payment extends CI_Model{		
		
		function dbGetPayments($term, $year){			
			$this->db->select('p.transaction_id, r.parent_fname, r.parent_lname, p.payment_date, p.amount_paid');
			$this->db->from('payments_details p, payments_master p1, registrations_master r, terms t');			
			$this->db->where('p.payment_id = p1.payment_id and r.registration_id = p1.registration_id and p1.term_id = t.term_id');
			if ($year!='All'){
				$this->db->where('YEAR(p.payment_date)', $year);		
			}	
			if ($term!='All'){
				$this->db->where('p1.term_id', $term);			
			}
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
		function dbGetPaymentDetails($transactionId){			
			$this->db->select('payment_date, amount_paid, payment_type');
			$this->db->from('payments_details');			
			$this->db->where('transaction_id', $transactionId);		
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
		function dbUpdatePayment($transactionId, $array){
			$this->db->where('transaction_id',$transactionId);
			$this->db->update('payments_details',$array);
			$this->db->select('p.transaction_id, r.parent_fname, r.parent_lname, p.payment_date, p.amount_paid');
			$this->db->from('payments_details p, payments_master p1, registrations_master r, terms t');			
			$this->db->where('p.payment_id = p1.payment_id and r.registration_id = p1.registration_id and p1.term_id = t.term_id');
			$this->db->where('p.transaction_id',$transactionId);
			$query = $this->db->get();
			return json_encode($query->result());		 
		}
		
	}

?>