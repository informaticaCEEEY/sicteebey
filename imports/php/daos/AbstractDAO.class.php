<?php
/**
 * Clase Abstracta y Base de los DAO's de la Tablas del Sistema
 * @name AbstractDAO.class.php
 */
interface ManipulateObjects {

	function createObject();
	function add();
	function update();
	function delete();
}

abstract class AbstractDAO {

	/**
	 * DataBaseConnection Conexión a Base de Datos
	 */
	protected $connection;

	/**
	 * string Nombre de la Tabla del DAO
	 */
	protected $table;

	/**
	 * string Llave primaria de la Tabla del DAO
	 */
	protected $keyValue;

	/**
	 * @brief Función Constructora de la Clase Abstracta de los DAOS's
	 * @param string $table La Tabla a la Cual se ara referencia
	 * @param string $keyValue Llave Primaria de la Tabla
	 */
	function __construct($table = '', $keyValue = '') {
		$this -> connection = new DataBaseConnection();
		$this -> table = $table;
		$this -> keyValue = $keyValue;
	}

	/**
	 * @brief Función que Limpia las Variables que se usan en las Sentencias SQL
	 * @param string $data La información posiblemente peligrosa
	 * @return string $data La información ya purgada
	 */
	public function sanitizesql($link, $data) {

		$data = trim($data);
		$data = str_replace("'", "''", $data);;
		return $data;
	}

	public function countActives($where = '', $whereFields = '', $join = '', $search = '') {
		$this -> connection -> startConnection();
		try {

			$fields = 'COUNT(e.id) as Total';
      $table = $this -> table . ' as e ' . $join;
			$result = $this -> connection -> select($fields, $table, $where, $whereFields);
			$this -> connection -> flushTable();
		} catch(Exception $e) {
			$this -> connection -> endConnection();
			return 0;
		}
		$this -> connection -> endConnection();
		return $result[0]['Total'];
	}
	
	public function countActivesBy($where='', $whereFields='', $join='', $fields='', $search='') {
		$this -> connection -> startConnection();
		try {

			if ($search != '') {

				if ($where != '')
					$where .= ' AND ';

				$where .= '(';
				$totalFields = count($fields);
				for ($i = 0; $i < $totalFields; $i++) {

					if ($i != ($totalFields - 1)) {
						$where .= $fields[$i] . " like :searchWord OR ";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%' OR ";
					} else {
						$where .= $fields[$i] . " like :searchWord";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%'";
					}
				}
				$where .= ')';
				if($whereFields != ''){
					$whereFields = array_merge($whereFields, array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%"));
				}else{
					$whereFields = array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%");
				}
			}
			
			$fields = 'COUNT(e.id) as Total';
			$table = $this -> table . ' as e ' . $join;
			$result = $this -> connection -> select($fields, $table, $where, $whereFields);
			$this -> connection -> flushTable();
		} catch(Exception $e) {
			$this -> connection -> endConnection();
			return 0;
		}
		$this -> connection -> endConnection();
		return $result[0]['Total'];
	}

	public function listAll($startLimit, $endLimit, $search, $fields, $order, $where = '', $whereFields = '', $join = '', $showFields = '') {

		$entries = array();
		try {

			$this -> connection -> startConnection();
			if($showFields != ''){
				$_fields = 'e.*, ' . $showFields;	
			}else{
				$_fields = 'e.*';
			}			
			$table = $this -> table . ' as e ' . $join;
			if (is_numeric($startLimit) != '' && is_numeric($endLimit)) {

				$limit = $this -> sanitizesql($this -> connection -> getLink(),$startLimit) . "," . $this -> sanitizesql($this -> connection -> getLink(),$endLimit);
			} else {
				$limit = '';
			}
			
			if ($search != '') {
				
				if ($where != '')
					$where .= ' AND ';

				$where .= '(';
				$totalFields = count($fields);
				for ($i = 0; $i < $totalFields; $i++) {

					if ($i != ($totalFields - 1)) {
						$where .= $fields[$i] . " like :searchWord OR ";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%' OR ";
					} else {
						$where .= $fields[$i] . " like :searchWord";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%'";
					}
				}
				$where .= ')';
				if($whereFields != ''){
					$whereFields = array_merge($whereFields, array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%"));	
				}else{
					$whereFields = array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%");
				}
			}			
			$matchentriess = $this -> connection -> select($_fields, $table, $where, $whereFields, $order, $limit);
			//$this -> connection -> flushTable();
			$this -> connection -> endConnection();
		} catch(Exception $e) {

			$this -> connection -> endConnection();
			return $entries;
		}		
		if (count($matchentriess) > 0) {

			foreach ($matchentriess as $currentEntry) {

				$entrie = $this -> createObject($currentEntry);
				array_push($entries, $entrie);
			}
		}
		//echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
		return $entries;
	}

    public function listAll2($startLimit, $endLimit, $search, $fields, $order, $where = '', $whereFields = '', $join = '', $showFields = '', $groupby='') {

        $entries = array();
        try {

            $this -> connection -> startConnection();
            if ($showFields != '') {
                $_fields = $showFields;
            } else {
                $_fields = 'e.*';
            }

            $table = $this -> table . ' as e ' . $join;
            if (is_numeric($startLimit) != '' && is_numeric($endLimit)) {

                $limit = $this -> sanitizesql($this -> connection -> getLink(),$startLimit) . "," . $this -> sanitizesql($this -> connection -> getLink(),$endLimit);
            } else {
                $limit = '';
            }
            
            if ($search != '') {
                
                if ($where != '')
                    $where .= ' AND ';

                $where .= '(';
                $totalFields = count($fields);
                for ($i = 0; $i < $totalFields; $i++) {

                    if ($i != ($totalFields - 1)) {
                        $where .= $fields[$i] . " like :searchWord OR ";
                        //$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%' OR ";
                    } else {
                        $where .= $fields[$i] . " like :searchWord";
                        //$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%'";
                    }
                }
                $where .= ')';
                if($whereFields != ''){
                    $whereFields = array_merge($whereFields, array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%"));    
                }else{
                    $whereFields = array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%");
                }
            }           
            $matchentriess = $this -> connection -> select2($_fields, $table, $where, $whereFields, $order, $limit, '', $groupby);
            //$this -> connection -> flushTable();
            $this -> connection -> endConnection();
        } catch(Exception $e) {

            $this -> connection -> endConnection();
            return $entries;
        }       
        /*if (count($matchentriess) > 0) {

            foreach ($matchentriess as $currentEntry) {
                $entrie = $this -> createObject($currentEntry);
                array_push($entries, $entrie);
            }
        }*/
        //echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
        return $matchentriess;
    }


	public function listAllObjects($startLimit, $endLimit, $search, $fields, $order, $where = '', $whereFields = '', $join = '', $showFields = '') {

		$entries = array();
		try {

			$this -> connection -> startConnection();
			if($showFields != ''){
				$_fields = 'e.*, ' . $showFields;	
			}else{
				$_fields = 'e.*';
			}			
			$table = $this -> table . ' as e ' . $join;
			if (is_numeric($startLimit) != '' && is_numeric($endLimit)) {

				$limit = $this -> sanitizesql($this -> connection -> getLink(),$startLimit) . "," . $this -> sanitizesql($this -> connection -> getLink(),$endLimit);
			} else {
				$limit = '';
			}
			
			if ($search != '') {
				
				if ($where != '')
					$where .= ' AND ';

				$where .= '(';
				$totalFields = count($fields);
				for ($i = 0; $i < $totalFields; $i++) {

					if ($i != ($totalFields - 1)) {
						$where .= $fields[$i] . " like :searchWord OR ";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%' OR ";
					} else {
						$where .= $fields[$i] . " like :searchWord";
						//$where .= $fields[$i] . " like '%" . $this -> sanitizesql($this -> connection -> getLink(),$search) . "%'";
					}
				}
				$where .= ')';
				if($whereFields != ''){
					$whereFields = array_merge($whereFields, array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%"));	
				}else{
					$whereFields = array('searchWord' => "%".$this -> sanitizesql($this -> connection -> getLink(),$search)."%");
				}
			}			
			$matchentriess = $this -> connection -> select($_fields, $table, $where, $whereFields, $order, $limit);
			//$this -> connection -> flushTable();
			$this -> connection -> endConnection();
		} catch(Exception $e) {

			$this -> connection -> endConnection();
			return $matchentriess;
		}
		/*
		if (count($matchentriess) > 0) {

			foreach ($matchentriess as $currentEntry) {

				$entrie = $this -> createObject($currentEntry);
				array_push($entries, $entrie);
			}
		}*/
		//echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
		return $matchentriess;
	}

	public function getBy($field, $search, $order = '') {

		try {

			$this -> connection -> startConnection();
			$objects = array();
			$results = $this -> connection -> select('*', $this -> table, $field . "= :field", array('field' => $this -> sanitizesql($this -> connection -> getLink(),$search)), $order);			
			foreach ($results as $result) {

				array_push($objects, $this -> createObject($result));
			}
			$this -> connection -> endConnection();
			return $objects;
		} catch(Exception $e) {			
			$this -> connection -> endConnection();
			return null;
		}
	}

	public function deleteObject($object) {

		try {

			$this -> connection -> startConnection();
			$objectData = $object -> dataVector();
			$this -> connection -> delete($this -> table, $this -> keyValue . "='" . $this -> sanitizesql($this -> connection -> getLink(),$objectData[0]) . "'");
			$this -> connection -> endConnection();
		} catch(Exception $e) {
			$this -> connection -> endConnection();
		}
	}

	public function updateObject($object) {

		try {
			
			$this -> connection -> startConnection();
			$fields = $this -> connection -> tableFields($this -> table);
			$objectData = $object -> dataVector();
			$values = '';
			$valField = array();
			for ($i = 1; $i < count($fields); $i++) {

				if ($i == (count($fields) - 1)) {

					$values .= $fields[$i] . "= :" . $fields[$i];
				} else {
					$values .= $fields[$i] . "= :" . $fields[$i] . ", ";
				}
			}
			for ($i = 1; $i < count($fields); $i++) {
				
				$valField[$fields[$i]] = $this -> sanitizesql($this -> connection -> getLink(),$objectData[$i]);
			}
			$n = $this -> connection -> update($this -> table, $values, $valField, $this -> keyValue . "='" . $this -> sanitizesql($this -> connection -> getLink(),$objectData[0]) . "'");
			$this -> connection -> endConnection();
		} catch(Exception $e) {
			$this -> connection -> endConnection();
		}
		return $n;
	}

	public function addObject($object) {

		try {

			$this -> connection -> startConnection();
			$fields = $this -> connection -> tableFields($this -> table);
			$objectData = $object -> dataVector();
			$values = "NULL,";
			for ($i = 1; $i < count($fields); $i++) {

				if ($i == (count($fields) - 1)) {

					$values .= ":" . $fields[$i];
				} else {
					$values .= ":" . $fields[$i] . ", ";
				}
			}
			for ($i = 1; $i < count($fields); $i++) {
				
				$valField[$fields[$i]] = $this -> sanitizesql($this -> connection -> getLink(),$objectData[$i]);
			}
			$insert=$this -> connection -> insert($this -> table, $values, $valField);
			$this -> connection -> endConnection();
			return $insert;
		} catch(Exception $e) {
			$this -> connection -> endConnection();
			return NULL;
		}
	}
	
	public function getByFields($search, $fields, $join = '', $order = '', $like = '', $where = '') {
		$entries = array();
		try {

			$this -> connection -> startConnection();
			$_fields = 'e.*';
			$table = $this -> table . ' as e' . $join;

			if ($search != '') {

				$where .= '(';
				$totalFields = count($fields);
				for ($i = 0; $i < $totalFields; $i++) {

					if ($i != ($totalFields - 1)) {
												
						$where .= $fields[$i] . " = '" . $this -> sanitizesql($this -> connection -> getLink(),$search[$i]) . "' AND ";
					} else {
						$where .= $fields[$i] . " = '" . $this -> sanitizesql($this -> connection -> getLink(),$search[$i]) . "'";
					}
				}
				$where .= ')';
			}
			$where .= $like;

			$matchentriess = $this -> connection -> select($_fields, $table, $where, $order);
			$this -> connection -> flushTable();
			$this -> connection -> endConnection();
		} catch (Exception $e) {

			$this -> connection -> endConnection();
			return $entries;
		}
		if (count($matchentriess) > 0) {

			foreach ($matchentriess as $currentEntry) {

				$entrie = $this -> createObject($currentEntry);
				array_push($entries, $entrie);
			}
		}
		return $entries;
	}

    public function getByFields2 ($startLimit,$endLimit,$fieldsNames='',$fieldValues='',$where='')
    {
        $entries = array();
        if(is_array($fieldsNames) && is_array($fieldValues)
            && count($fieldValues)==count($fieldValues))
        {

            try {

                $this -> connection -> startConnection();
                $_fields = 'e.*';
                $table = $this -> table . ' as e';
                if (is_numeric($startLimit) != '' && is_numeric($endLimit)) {
                    $limit = $this -> sanitizesql($this -> connection -> getLink(),$startLimit) . "," .
                        $this -> sanitizesql($this -> connection -> getLink(),$endLimit);
                } else {
                    $limit = '';
                }
                if($where !='')
                {
                    $where .= ' and ';
                }
                $where .= '(';
                for ($i = 0; $i < count($fieldsNames); $i++) {

                    if ($i != (count($fieldsNames) - 1)) {

                        $where .= "`".$fieldsNames[$i] . "`='" . $this -> sanitizesql($this -> connection -> getLink(),$fieldValues[$i]) . "' AND ";
                    } else {
                        $where .= "`".$fieldsNames[$i] . "`='" . $this -> sanitizesql($this -> connection -> getLink(),$fieldValues[$i])."'" ;
                    }
                }
                $where .= ')';
                $matchentriess = $this -> connection -> select($_fields, $table, $where, '', $limit);
                $this -> connection -> flushTable();
                $this -> connection -> endConnection();
            } catch(Exception $e) {

                $this -> connection -> endConnection();
                return $entries;
            }
            if (count($matchentriess) > 0) {
                foreach ($matchentriess as $currentEntry) {
                    $entrie = $this -> createObject($currentEntry);
                    array_push($entries, $entrie);
                }
            }
            return $entries;
        }
        else
        {
            echo "No";
            return false;
        }
    }
}
?>