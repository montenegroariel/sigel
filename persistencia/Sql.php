    <?php
class Sql
{
  private $_colWhere = array();
  private $_colSelect = array('*');
  private $_colFrom = array();
  private $_colFuncion = array();
  private $_colJoin = array();
  private $_colValue = array();
  
  public function addTable($table)
  {
    $this->_colFrom[] = $table;
  }
  
  public function addWhere($where)
  {
    $this->_colWhere[] = $where;
  }
  
  public function addFuncion($funcion)
  {
    $this->_colFuncion[] = $funcion;
  }
  
  public function addInsert($insert)
  {
    $this->_colInsert[] = $insert;
  }
  
  public function addSelect($select)
  {
    $this->_colSelect[] = $select;
  }
  
  public function addJoin($join)
  {
    $this->_colJoin[] = $join;
  }
  
  public function addValue($value)
  {
    $this->_colValue[] = $value;
  }
  
  public function consultar()
  {
    $select = implode(',',array_unique($this->_colSelect));
    $from   = implode(',',array_unique($this->_colFrom));
    $where  = implode(' AND ',array_unique($this->_colWhere));  
    if($where != ''){
        $where = ' WHERE '.$where;
    }
        //echo 'SELECT '.$select.' FROM '.$from.$where;
        return 'SELECT '.$select.' FROM '.$from. $where;
    }
  
    public function guardar()
    {
        $from   = implode(',',array_unique($this->_colFrom));
        $funcion = implode(',',array_unique($this->_colFuncion));
        $values = implode(',',($this->_colValue));   
        return $funcion . $from . "VALUES (" . $values . ")";
    }
    
    public function eliminar()
    {
        $from   = implode(',',array_unique($this->_colFrom));
        $funcion = implode(',',array_unique($this->_colFuncion));
        $where = implode(',',array_unique($this->_colWhere));
        //echo $funcion .".". $from . " WHERE " . $from .".". $where;
        return $funcion .".". $from . " WHERE " . $from .".". $where;
    }

    public function modificar()
    {
        $from   = implode(',',array_unique($this->_colFrom));
        $funcion = implode(',',array_unique($this->_colFuncion));
        $values = implode(',',$this->_colValue);
        $where = implode(',',$this->_colWhere);
        //echo $funcion . $from . $values . " WHERE " .$where;
        //break;
        return $funcion . $from . $values . " WHERE " .$where;
    }
 
    public function __toString()
    {
        return $this->consultar();
    }
}
