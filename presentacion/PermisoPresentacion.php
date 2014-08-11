<?php
require_once 'configuracion.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Permiso.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Modulo.php';
require_once DOM . DIRECTORY_SEPARATOR . 'Perfil.php';


abstract class PermisoPresentacion
{
    public static function nuevoPermiso()
    {
        $form = self::_mostrarFormNuevoPermiso();
        return $form;
    }
    
    public static function guardarPermiso($id,$id_perfil,$id_modulo,$agregar,$modificar,$eliminar)
    {
        $permiso = new Permiso($id,$id_perfil,$id_modulo,$agregar,$modificar,$eliminar);
        return $permiso->guardarPermiso();
    }
    
    public static function modificarPermiso($id)
    {
        $form = self::_mostrarFormModificarPermiso($id);
        return $form;
    }
    
    public static function guardarPermisoModificado($id, $id_perfil,$id_modulo,$agregar,$modificar,$eliminar)
    {
        $permiso = new Permiso($id, $id_perfil,$id_modulo,$agregar,$modificar,$eliminar);
        return $permiso->guardarPermisoModificado();
    }
    
    public static function eliminarPermiso($id)
    {
        $permiso = new Permiso;
        $permiso->eliminarPermiso($id);
    }
    
    static public function listadoPermisos($id)
    { 
        $permiso_sesion = Permiso::getPermiso($_SESSION['perfil'], $_GET['modulo']);
        $habilitado = ($permiso_sesion->getModificar()) ? '' : " disabled='disabled'";
        $permisos_arr = Permiso::getPermisos($id);
        $perfiles_arr = Perfil::getPerfiles();
        $id_arr = array();
        $selected = '';
        $retorno = "<div class='row'>";
        $retorno .= "<div class='col-lg-12'>";
        $retorno .= "<div class='panel panel-default'>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .= "</div>";
        $retorno .= "<div class='panel-body'>";
        $retorno .= "<div class='table-responsive'>";
        $retorno .= "<div style='width:50%'class='form-group'>";
        $retorno .= "<form method='post' action='' >";
        $retorno .= "<select onchange = 'this.form.submit()' name='id_perfil' id='id_perfil'  class='form-control'>";
            foreach($perfiles_arr as $perfil){
                if($id === $perfil->getId())
                {$selected = 'selected';}else{$selected = '';}
                $retorno .= "<option ". $selected ." value=".$perfil->getId().">". $perfil->getDetalle() ."</option>";
            }
        $retorno .= "</select>";
        $retorno .= " </form>";
        $retorno .= "</div>";
        $retorno .= "<form method='post' action='?modulo=". $_GET['modulo'] ."&accion=guardarPermisoModificado'>";
        $retorno .= "<table class='table table-striped table-bordered table-hover' id='dataTables-example'>";
        $retorno .= "<thead>";
        $retorno .= "<tr>";
        $retorno .= "<th  style='text-align:center'>Modulo</th>";
        $retorno .= "<th  style='text-align:center'>Agregar</th>";
        $retorno .= "<th  style='text-align:center'>Modificar</th>";
        $retorno .= "<th  style='text-align:center'>Eliminar</th>";
        $retorno .= "<td  style='text-align:center'><i class='fa fa-ban fa-fw'></i></td>";
        $retorno .= "</tr>";
        $retorno .= "</thead>";
        $retorno .= "<tbody>";
        $modulo = new Modulo();
        //echo highlight_string(var_dump($permisos_arr));
        
        foreach($permisos_arr as $permiso){

        $id_arr[] = $permiso->getId();


            $modulo = Modulo::getModulo($permiso->getModulo());

                if ($modulo->getPadre() == 0)
                {
                $id_modulo = $modulo->getId();

            $retorno .= "<tr class='odd gradeX'>";			
            $retorno .= "<td><i class='fa ". $modulo->getIcono() ." fa-fw'></i> ". $modulo->getDetalleModulo($permiso->getModulo()) ."</td>";
            $retorno .= "<td></td>";
            $retorno .= "<td></td>";
            $retorno .= "<td></td>";
            $retorno .= "<td></td>";
            
            
            $retorno .= "</tr>";
                $retorno .= "</li>";

                    foreach($permisos_arr as $permiso)
                    {   
                        $submodulo = Modulo::getModulo($permiso->getModulo());
                        if($id_modulo == $submodulo->getPadre()){    

                            $retorno .= "<tr class='odd gradeX'>";			
                            $retorno .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa ". 
                                $submodulo->getIcono() ." fa-fw'></i>". 
                                $submodulo->getDetalleModulo($permiso->getModulo()) ."</td>";

                            $agregar = ($permiso->getAgregar()) ? ' checked' : '';
                            $retorno .= "<td align='center'><input name='agregar_". $permiso->getId() ."'  type='checkbox'". $agregar ." ". $habilitado . "></td>";
                            
                            $modificar = ($permiso->getModificar()) ? ' checked' : '';
                            $retorno .= "<td align='center'><input name='modificar_". $permiso->getId() ."'  type='checkbox'". $modificar ." ". $habilitado ."></td>";
                            
                            $eliminar = ($permiso->getEliminar()) ? ' checked' : '';
                            $retorno .= "<td align='center'><input name='eliminar_". $permiso->getId() ."'  type='checkbox'". $eliminar ." ". $habilitado . "></td>";
                            
                            
                            if($permiso_sesion->getEliminar()){
                                $retorno .= "<td align='center'><a href='?modulo=". $_GET['modulo'] ."&accion=eliminarPermiso&id=".$permiso->getId()."''><i class='fa fa-eraser fa-fw'></i></a></td>";
                            }else{
                                $retorno .= "<td align='center'><i class='fa fa-eraser fa-fw'></i></td>";
                            }
                            
                            
                            $retorno .= "</tr>";
                                $retorno .= "</li>";
                        }
                    }    
                
        }


        } 
       
        $retorno .= "</tbody>";
        $retorno .= "</table>";
        
        if($permiso_sesion->getAgregar()){
            $retorno .= "<div align='right' class='panel-heading'>";    
            $retorno .="<a href='?modulo=". $_GET['modulo'] ."&accion=nuevoPermiso&id_perfil=". $id ."'><button type='button' class='btn btn-primary btn-sm'>Agregar Permiso</button></a>";
            if($permiso_sesion->getModificar()){
                $retorno .="&nbsp;&nbsp;<a><button type='button' onclick='this.form.submit()' class='btn btn-primary btn-sm'>Modificar Permiso</button></a>";
                $retorno .="<input type='hidden' name='id_arr' value='". serialize($id_arr) ."'>";
                $retorno .= " <input type=hidden value='". $id ."' name='id_perfil' id='id_perfil'>";
                $retorno .= " <input type=hidden value='". $_GET['modulo'] ."' name='id_modulo' id='id_modulo'>";
         }
            $retorno .= "</div>";
        }
    
        $retorno .= " </form>";
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";
        $retorno .= "</div>";     
        return $retorno;   
    }
    
    static public function _mostrarFormNuevoPermiso()
    {
        $modulos_arr = Modulo::getModulos();
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarPermiso ' method='post'> ";
        $retorno .= " <input type=hidden value='". $_GET['id_perfil'] ."' name='id_perfil' id='id_perfil'>";
        $retorno .= " <label>Modulo</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<select name='id_modulo' class='form-control'>";
        foreach($modulos_arr as $modulo){
                $retorno .= "<option value=".$modulo->getId().">". $modulo->getDetalle() ."</option>";
            }
        $retorno .= "</select>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }
    
    static public function _mostrarFormModificarPermiso($id)
    {
        $perfil = Permiso::getPermiso($id);
        $retorno = "<form style='width:50%' role='form' action='?modulo=". $_GET['modulo'] ."&accion=guardarPermisoModificado&id=". $perfil->getId() ."' method='post'> ";
        $retorno .= " <label>Detalle</label>";
        $retorno .= "<div class='form-group'>";
        $retorno .= "<input class='form-control'name='detalle' placeholder='Detalle' value='". $perfil->getDetalle() ."'>";
        $retorno .= "</div>";
        $retorno .= "<div align='right' class='panel-heading'>";
        $retorno .="<input type='submit' class='btn btn-primary btn-sm'></submit>";
        $retorno .= "</div>";
        $retorno .= "</form>";
        return $retorno;
    }
}


