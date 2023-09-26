<?php
/**
 * Clase que permite conectarse a la base de datos definida en el constructor
 * @package DataBase
 * @name DataBaseConnection.class.php
 * @version 1.0
 */

define("NAMES_U8", "SET NAMES utf8");

class  DataBaseConnection {
	
	/**
	 * El Servidor de Alojamiento
	 * @var Text
	 */
	private $server;

	/**
	 * El usuario de Conexi�n a la Base de Datos
	 * @var Text
	 */
	private $user;

	/**
	 * Contrase�a de Acceso a la Base de Datos
	 * @var Text
	 */
	private $password;

	/**
	 * Base de Datos a la cual se desea Conectar
	 * @var Text
	 */
	private $database;

	/**
	 * Conexi�n para Transacciones
	 * @var Connection
	 */
	private $link;
	
	

	/**
	 * Constructor de la Clase DataBaseConnection con los datos del servidor de
	 * base de Datos
	 */
	public function __construct() {

	   	$this -> server = 'localhost';
	   	$this -> user = 'root';
	   	$this -> password = '';
		$this -> dataBase = 'sicteebey';

	}

	public function getLink() {
		return $this->link;
	}

	public function flushTable() {
		//mysqli_query($this -> link, "FLUSH TABLES");
		//$sql = $this -> link->prepare('FLUSH TABLES');
		//s$sql->execute();
	}

	/**
	 * Funci�n que establece la conexi�n con la base de datos
	 */
	public function startConnection() {
		
		try {
			$options = array(
			    PDO::MYSQL_ATTR_INIT_COMMAND => NAMES_U8,
			);
			$this->link = new PDO('mysql:host='.$this -> server.';dbname='.$this -> dataBase, $this -> user, $this -> password, $options);
			$this->link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "ERROR: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	/**
	 * Funci�n que culmina la conexi�n con la base de datos
	 */
	public function endConnection() {

		$conn = null;
	}

	/**
	 * Funci�n que permite hacer la operaci�n select de la base de datos
	 * @param text $what Se refiere al conjunto de columnas que se desean
	 * seleccionar
	 * @param text $table Es la tabla de la cual se desea realizar al selecci�n
	 * @param text $where Clausula where de la sentencia, el campo es �Opcional!
	 * @param text $orderby Clausula order by de la sentencia, el campo es
	 * �Opcional!
	 * @param text $limit Clausula limit de la sentencia, el campo es �Opcional!
	 * @param text $ln Clausula ln de la sentencia, el campo es �Opcional!
	 * @return multitype: ArrayObject La funci�n devuelve el arreglo generado por
	 * lo
	 * obtenido al ejecutar la sentencia select
	 */
	public function select($what, $table, $where = "", $fieldSearch="", $orderby = "", $limit = "", $ln = "") {

		$rdata = array();

		$query = "SELECT " . $what . " FROM " . $table;
		if ($where != "") {

			$query .= "  WHERE " . $where;
		}
		if ($orderby != "") {

			$query .= "  ORDER BY " . $orderby;
		}
		if ($limit != "") {
			$query .= "  LIMIT " . $limit;
		}
		//echo($query."<br/>");
		$rquery = $this -> link->prepare($query);
		//print_r($fieldSearch);
		//echo("<br/>");
		if($fieldSearch != ''){
			$rquery->execute($fieldSearch);
		}else{
			$rquery->execute();
		}
		/*while ($arr = $rquery->fetch()) {
		    // do_other_stuff();
		    $result[] = $arr;
		}*/
		//$result = $rquery->fetchAll();
		$result = $rquery->fetchAll(PDO::FETCH_ASSOC);
		///echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
		return $result;
	}

    public function select2($what, $table, $where = "", $fieldSearch="", $orderby = "", $limit = "", $ln = "", $groupby= "") {

        $rdata = array();

        $query = "SELECT " . $what . " FROM " . $table;
        if ($where != "") {

            $query .= "  WHERE " . $where;
        }
		if ($groupby != "") {

          $query .= "  GROUP BY " . $groupby;
      }
        if ($orderby != "") {

            $query .= "  ORDER BY " . $orderby;
        }
        if ($limit != "") {
            $query .= "  LIMIT " . $limit;
        }
        //echo($query."<br/>");
        $rquery = $this -> link->prepare($query);
        //print_r($fieldSearch);
        //echo("<br/>");
        if($fieldSearch != ''){
            $rquery->execute($fieldSearch);
        }else{
            $rquery->execute();
        }
        /*while ($arr = $rquery->fetch()) {
            // do_other_stuff();
            $result[] = $arr;
        }*/
        $result = $rquery->fetchAll(PDO::FETCH_ASSOC);
        //echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
        return $result;
    }

	public function select_union($what, $table, $where = "", $fieldSearch="", $orderby = "", $limit = "", $ln = "", $groupby= "", $union = "") {

        $rdata = array();

        $query = "SELECT " . $what . " FROM " . $table;
        if ($where != "") {

            $query .= "  WHERE " . $where;
        }
		if ($groupby != "") {

          $query .= "  GROUP BY " . $groupby;
      }
        if ($orderby != "") {

            $query .= "  ORDER BY " . $orderby;
        }
        if ($limit != "") {
            $query .= "  LIMIT " . $limit;
        }
		if ($union != "") {
            $query .= "  UNION ";
        }
        //echo($query."<br/>");
        //$rquery = $this -> link->prepare($query);
        //print_r($fieldSearch);
        //echo("<br/>");
        /*if($fieldSearch != ''){
            $rquery->execute($fieldSearch);
        }else{
            $rquery->execute();
        }*7
        /*while ($arr = $rquery->fetch()) {
            // do_other_stuff();
            $result[] = $arr;
        }*/
        //$result = $rquery->fetchAll(PDO::FETCH_ASSOC);
        //echo round(memory_get_usage() / (1024*1024),3) .' MB<br />';
        return $query;
    }


	/**
	 * Funci�n que permite agregar un nuevo elemento a una tabla determinada
	 * @param text $table La tabla a la cual se desea agregar el elemento
	 * @param text $values La lista de valores a ingresar en la tabla.
	 * Nota: La variable $values, debera de estar ordenada conforme al orden de
	 * las columnas de la tabla.
	 * Si la tabla tuviera la estuctura id, nombre, entonces los datos de value
	 * serian:
	 * $value="'', 'El Nombre'", esto si es que id es autoincrementable y no
	 * queremos alterar la generaci�n
	 * automatica de los indices
	 * @param text $ln Clausa ln de la sentencia, el parametro es �Opcional!
	 */
	public function insert($table, $values, $fieldSearch, $ln = "") {

		$sql = $this -> link->prepare(NAMES_U8);
		$sql->execute();

		$campos = $this -> tableFields($table);

		$query = "INSERT INTO " . $table . " ( ";

		for ($i = 0; $i < count($campos); $i++) {

			if ($i == 0) {

				$query .= "`".$campos[$i]."`";
			} else {
				$query .= ", `" . $campos[$i]."`";
			}
		}
		$query .= " ) VALUES ( " . $values . ")";
		//echo($query."<br/>");
		//exit;
		$rquery = $this -> link->prepare($query);
		foreach($fieldSearch as $key => $value){
			$rquery->bindValue(':'.$key, $value);
		}
		$rquery->execute();
		return $this -> link->lastInsertId();
	}

	/**
	 * Funci�n que permite realizar una actualizaci�n a una entrada o conjunto de
	 * entradas de la tabla
	 * de acuerdo a lo dado en la clausa where
	 * @param text $table La tabla a la cual se desea agregar el elemento
	 * @param text $setval La lista de valores a ingresar en la tabla.
	 * @param text $where La calusa where de la sentencia
	 * @param text $ln Clausa ln de la sentencia, el parametro es �Opcional!
	 */
	public function update($table, $setval, $fieldSearch, $where = "", $ln = "") {

		//mysqli_query($this -> link, "SET NAMES utf8") or die("NO SE PUEDE CAMBIAR EL CONJUNTO DE CARACTERES");
		$sql = $this -> link->prepare(NAMES_U8);
		$sql->execute();
		$query = "UPDATE  " . $table . " SET " . $setval;

		if ($where != "") {

			$query .= "  WHERE " . $where;
		}
		//echo($query."<br/>");
		//print_r($query);
		//exit;
		$rquery = $this -> link->prepare($query);
		foreach($fieldSearch as $key => $value){
			$rquery->bindValue(':'.$key, $value);
		}
		$rquery->execute();
		return $rquery;
	}

	/**
	 * Funci�n que permite borrar una entrada de la tabla
	 * de acuerdo a lo dado en la clausa where
	 * @param text $table La tabla a la cual se desea agregar el elemento
	 * @param text $where La calusa where de la sentencia
	 * @param text $ln Clausa ln de la sentencia, el parametro es �Opcional!
	 */
	public function delete($table, $where = "", $ln = "") {

		$sql = $this -> link->prepare(NAMES_U8);
		$sql->execute();

		$query = "DELETE FROM " . $table;

		if ($where != "") {

			$query .= "  WHERE " . $where;
		}
		//echo $query."<br/>";
		$rquery = $this -> link->prepare($query);
		$rquery->execute($fieldSearch);
		return $rquery;
	}

	public function throwException($message = null, $code = null) {
		throw new Exception($message, $code);
	}

	/**
	 * Funci�n que devuelve los nombres de los campo de una tabla dada
	 * @param text $table El nombre de la tabla
	 * @return Array Devuelve un arreglo con el nombre de los campos de la tabla
	 */
	public function tableFields($table) {

		$query = "SHOW COLUMNS FROM " . $table;
		$sql = $this -> link->prepare(NAMES_U8);
		$sql->execute();
		$sql = $this -> link->prepare($query);
		$sql->execute();
		$result = $sql->fetchAll();
		foreach($result as $key => $col ){
			$row[] = $col['Field'];
		}
		return $row;
	}

	public function executeSentence($sentence) {

		mysqli_query($this -> link, "SET NAMES utf8") or die("NO SE PUEDE CAMBIAR EL CONJUNTO DE CARACTERES");
		////echo "Sentencia: ".$sentence;
		return mysqli_query($this -> link, $sentence) or die("NO SE PUEDE ELIMINAR");
	}

	/**
	 * Funci�n que cuenta las entradas en una tabla dada
	 * @param text $table La tabla a la cual se le contaran las entradas
	 * @return number N�mero de entradas de la tabla
	 */
	public function countTableEntries($table) {
		$query = "SELECT * FROM " . $table;

		$sql = $this -> link->prepare(NAMES_U8);
		$sql->execute();

		$sql = $this -> link->prepare($query);
		$sql->execute();
		$count = $sql->columnCount();

		return $count;
	}

}
?>
