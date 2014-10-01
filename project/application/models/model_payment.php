<?php 
	class model_payment extends CI_Model{		
		
		function dbGetPayments($term, $year){			
			$this->db->select('p.transaction_id, r.parent_fname, r.parent_lname, p.payment_date, p.amount_paid');
			$this->db->from('payments_details p, payments_master p1, registrations_master r, 
				terms t, registrations_details rd, groups_master g');			
			$this->db->where('rd.registration_id = r.registration_id and p1.member_id = rd.member_id and
				p.payment_id = p1.payment_id and p1.group_id = g.group_id and g.term_id = t.term_id');
					
			if ($term!='All'){
				$this->db->where('g.term_id', $term);			
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
			$this->db->from('payments_details p, payments_master p1, registrations_master r, 
				terms t, registrations_details rd, groups_master g');			
			$this->db->where('rd.registration_id = r.registration_id and p1.member_id = rd.member_id and
				p.payment_id = p1.payment_id and p1.group_id = g.group_id and g.term_id = t.term_id');
			$this->db->where('p.transaction_id',$transactionId);
			$query = $this->db->get();
			return json_encode($query->result());		 
		}
		
	}

?>