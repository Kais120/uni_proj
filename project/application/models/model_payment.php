<?php 
	class model_payment extends CI_Model{		
		
		function dbGetPayments($term, $year){
			$string='';
			$this->db->select('pm.payment_id, rm.parent_fname, rm.parent_lname, 
				rd.member_fname, rd.member_lname, YEAR(t.start_date) as year, 
				t.term_description, s.sport_description, sk.skill_band, 
				gm.group_name, IFNULL(SUM(pd.amount_paid),0) as sum, pm.total_amount', false);
			$this->db->from('payments_master pm, registrations_master rm, registrations_details rd, terms t, sports s, skills_master sk, groups_master gm');			
			$this->db->join('payments_details pd', 'pd.payment_id = pm.payment_id', 'left');
			$this->db->where('rd.member_id = pm.member_id and rd.registration_id = rm.registration_id and pm.group_id = gm.group_id and 
				gm.term_id = t.term_id and gm.skill_id = sk.skill_id and sk.sport_id = s.sport_id');
				
			if ($term != 'all' && $term != 'empty')
				$this->db->where('gm.term_id',$term);
			if ($year != 'all' && $year != 'empty')
				$this->db->where('YEAR(t.start_date) ',$year);
			
			$this->db->group_by("pm.payment_id"); 
				
			$query = $this->db->get();
			foreach ($query->result() as $row){
				if ($row->sum<$row->total_amount)
					$string.='<tr class="critical">';
				else
					$string.='<tr>';
				$string.='<td class="payment_id">'.$row->payment_id.'</td>
						<td>'.$row->parent_fname.' '.$row->parent_lname.'</td>
						<td>'.$row->member_fname.' '.$row->member_lname.'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->term_description.'</td>
						<td>'.$row->sport_description.'</td>
						<td>'.$row->skill_band.'</td>
						<td>'.$row->group_name.'</td>
						<td>'.$row->sum.'/'.$row->total_amount.'</td>
					</tr>';
			}
			
			return $string;				
		}
		
		function db_get_payment_details($paymentId){			
			$this->db->select('number_lessons, total_amount');
			$this->db->from('payments_master');			
			$this->db->where('payment_id', $paymentId);		
			$query = $this->db->get();
			if ($query->num_rows() > 0){
				$row = $query->row();
				$array = array(
					'numlessons' => $row->number_lessons,
					'total' => $row-> total_amount
				);
				return json_encode($array);	
			}			
		}
		
		function db_save_payment($paymentId, $array){
			$this->db->where('payment_id',$paymentId);
			$this->db->update('payments_master',$array);				 
		}
		
		function db_get_transactions($paymentId){
			$string = '';
			$this->db->select('transaction_id, payment_date, payment_type, amount_paid');
			$this->db->from('payments_details');	
			$this->db->where('payment_id',$paymentId);			
			$query = $this->db->get();
			foreach ($query->result() as $row){				
				$string.='<tr>
						<td class="transaction_id">'.$row->transaction_id.'</td>
						<td>'.$row->payment_date.'</td>
						<td class="payment_type">'.$row->payment_type.'</td>
						<td class="amount">'.$row->amount_paid.'</td>						
					</tr>';
			}
			
			return $string;	
		}
		
		function db_add_transaction($array){
			$this->db->insert('payments_details', $array);
		}
		
		function db_save_transaction($transactionId, $array){
			$this->db->where('transaction_id',$transactionId);
			$this->db->update('payments_details',$array);
		}
			
		function db_get_parent_payments($term, $parent){
			$string='';
			$this->db->select('pm.payment_id, rd.member_fname, rd.member_lname, YEAR(t.start_date) as year, 
				t.term_description, s.sport_description, sk.skill_band, 
				gm.group_name, IFNULL(SUM(pd.amount_paid),0) as sum, pm.total_amount', false);
			$this->db->from('payments_master pm, registrations_master rm, registrations_details rd, terms t, sports s, skills_master sk, groups_master gm');			
			$this->db->join('payments_details pd', 'pd.payment_id = pm.payment_id', 'left');
			$this->db->where('rd.member_id = pm.member_id and rd.registration_id = rm.registration_id and pm.group_id = gm.group_id and 
				gm.term_id = t.term_id and gm.skill_id = sk.skill_id and sk.sport_id = s.sport_id');
				
			$this->db->where('gm.term_id',$term);			
			$this->db->where('rm.registration_id',$parent);	
			$this->db->group_by("pm.payment_id"); 
				
			$query = $this->db->get();
			foreach ($query->result() as $row){
				if ($row->sum<$row->total_amount)
					$string.='<tr class="critical">';
				else
					$string.='<tr>';
				$string.='<td class="payment_id">'.$row->payment_id.'</td>						
						<td>'.$row->member_fname.' '.$row->member_lname.'</td>
						<td>'.$row->year.'</td>
						<td>'.$row->term_description.'</td>
						<td>'.$row->sport_description.'</td>
						<td>'.$row->skill_band.'</td>
						<td>'.$row->group_name.'</td>
						<td>'.$row->sum.'/'.$row->total_amount.'</td>
					</tr>';
			}
			
			return $string;			
		}
	}

?>