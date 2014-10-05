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
		
		function dbSavePayment($transactionId, $array){
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
		
		function dbUpdatePayment($transactionId, $array){
			$this->db->where('transaction_id',$transactionId);
			$this->db->update('payments_details',$array);
		}
		
		function dbGetPaymentsList($parent, $term){
			$string = '';
			$this->db->select('pd.transaction_id, rd.member_fname, rd.member_lname, gm.group_name, pd.amount_paid, pd.payment_type, pm.total_amount, pd.payment_date');
			$this->db->from('payments_details pd, registrations_details rd, registrations_master rm, groups_master gm, payments_master pm');
			$this->db->where('rd.registration_id = rm.registration_id and pd.payment_id = pm.payment_id 
				and rd.member_id = pm.member_id and pm.group_id = gm.group_id');
			$this->db->where('rm.registration_id',$parent);
			$this->db->where('gm.term_id',$term);
			$query = $this->db->get();
			$result = $query->result();
			
			foreach ($result as $row){
				$string.='<tr><td class="payment_id">'.$row->transaction_id.'</td>
				<td>'.$row->member_fname.'</td><td>'.$row->member_lname.'</td>
				<td>'.$row->group_name.'</td><td class="amount">'.$row->amount_paid.'</td>
				<td class="payment_type">'.$row->payment_type.'</td><td class="payment_date">'.$row->payment_date.'</td>
				<td>'.$row->total_amount.'</td></tr>';
				
			}
			
			return $string;
		}
		
		function dbGetPaymentDetailsParent($transactionId){
			$payId = 0;
			$array = array(
				'overall' => '',				
				'paid' => 0,
				'type' => '',
				'date' => '0000-00-00'
			);
			$this->db->select("pm.total_amount, pm.payment_id, pd.amount_paid, pd.payment_type, pd.payment_date");
			$this->db->from('payments_details pd, payments_master pm');
			$this->db->where('pd.payment_id = pm.payment_id');
			$this->db->where('pd.transaction_id', $transactionId);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0){
				$row = $query->row();				
				$array['paid'] = $row->amount_paid;
				$array['type'] = $row->payment_type;
				$array['date'] = $row->payment_date;
				$payId = $row->payment_id;
				$total = $row->total_amount;				
				$this->db->select('sum(amount_paid) as sum');
				$this->db->from('payments_details');				
				$this->db->where('payment_id', $payId);
				$query = $this->db->get();
				if ($query->num_rows() > 0){
					$row = $query->row();
					$array['overall'] = $row->sum.'/'.$total;
					return json_encode($array);
				}				
			}
		}
		
		function dbGetPaymentDetailsGroup($group, $child){
			$array = array (
				'total' => 0,
				'num' => 0
			);
			$this->db->select('total_amount, number_lessons');
			$this->db->from('payments_master');			
			$this->db->where('group_id', $group);
			$this->db->where('member_id', $child);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$row = $query->row();
				$array['total'] = $row->total_amount;
				$array['num'] = $row->number_lessons;
			}
			return json_encode($array);
		}
		
		function dbUpdatePaymentGroup($groupId, $memberId, $array){
			$this->db->where('group_id',$groupId);
			$this->db->where('member_id',$memberId);
			$this->db->update('payments_master',$array);
		}
		
		function dbAddNewPayment($groupId, $memberId, $array){
			$this->db->select('payment_id');
			$this->db->from('payments_master');
			$this->db->where('group_id',$groupId);
			$this->db->where('member_id',$memberId);
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$row = $query->row();
				$array['payment_id'] = $row->payment_id;
				$this->db->insert('payments_details', $array);
			}
			
		}
	}

?>