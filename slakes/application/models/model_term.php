<?php 
	class model_term extends CI_Model{		
		
		function dbPull(){
			$query = $this->db->query('SELECT DISTINCT YEAR(start_date) AS year FROM terms');		
			$array = $query->result();		
			return $array;					
		}	
		
		function db_get_term_details($year){			
			$string='';
			$this->db->select('term_id, term_description');
			$this->db->from('terms');
			if ($year!='All'){
				$this->db->where('YEAR(start_date)', $year);			
			}
			$query = $this->db->get();
			foreach ($query->result() as $row){
				$string.='<option value="'.$row->term_id.'">'.$row->term_description.'</option>';
			}
			return ($string);	
		}
		
		function db_add_term ($array){
			$dateStart = new DateTime($array['start_date']);
			$dateEnd = new DateTime($array['end_date']);
			if ($dateStart>=$dateEnd)
				return 'fail';
			else{
				$this->db->insert('terms', $array);
				return 'success';
			}
		}
		
		function db_update_term ($array, $key){
			$dateStart = new DateTime($array['start_date']);
			$dateEnd = new DateTime($array['end_date']);
			if ($dateEnd<=$dateStart)
				return 'fail';
			else{
				$this->db->where('term_id',$key);
				$this->db->update('terms',$array);
				return 'success';
			}
		}
		
		function db_get_year_select(){
			$query = $this->db->query('SELECT DISTINCT YEAR(start_date) AS year FROM terms');		
			$result = $query->result();
			$string = '';
			foreach ($result as $row){
				if (date("Y") == $row->year)
					$string.='<option value="'.$row->year.'" selected>'.$row->year.'</option>';
				else
					$string.='<option value="'.$row->year.'">'.$row->year.'</option>';
			}			
			return $string;
		}
		
		function db_get_term_select($year){
			$this->db->select('term_id, term_description');
			$this->db->from('terms');
			$this->db->where('YEAR(start_date)', $year);
			$query = $this->db->get();
			$result = $query->result();
			$string = '';
			foreach ($result as $row){
				$string.='<option value="'.$row->term_id.'">'.$row->term_description.'</option>';
			}			
			return $string;
		}
		
		function db_get_terms_details($year){			
			$this->db->select('*');
			$this->db->from('terms');
			if ($year!='All'){
				$this->db->where('YEAR(start_date)', $year);			
			}
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
	}

?>