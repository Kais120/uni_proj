<?php 
	class model_term extends CI_Model{		
		
		function dbPull(){
			$query = $this->db->query('SELECT DISTINCT YEAR(start_date) AS year FROM terms');		
			$array = $query->result();		
			return $array;					
		}	
		
		function dbGetTermDetails($year){			
			$this->db->select('*');
			$this->db->from('terms');
			if ($year!='All'){
				$this->db->where('YEAR(start_date)', $year);			
			}
			$query = $this->db->get();
			return json_encode($query->result());	
		}
		
		function dbAddTerm ($array){
			$this->db->insert('terms', $array);
		}
		
		function dbUpdateTerm ($array, $key){
			$this->db->where('term_id',$key);
			$this->db->update('terms',$array);
		}
		
	}

?>