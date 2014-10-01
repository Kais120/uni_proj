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
		
		function dbGetYearSelect(){
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
		
		function dbGetTermSelect($year){
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
		
	}

?>