<?php

// No direct access
defined('_JEXEC') or die;

//~ //jimport('joomla.application.component.modelform');
//~ echo '<br/> Antes de entrar vista.hmtl entra en modelo de la vista. <br/>';
//~ echo '<br/> mod ->vista1.php  <br/>';
//~ echo '<br/> El objeto $controler y $this no existe... por lo que no podemos acceder  <br/>';

			
class CallcenterModelRespuesta extends JModelList
{
	
	public function getComprobar()
	{
			
            $app = JFactory::getApplication();
            $jinput = $app->input; 
			$data =$jinput->getArray($_POST);;
			$datos = $data['jform'];
            // Comprobamos si intentos es 1 , porque si es mas, quiere decir que
            // refresco o ya grabo.
            $session = JFactory::getSession();
            // Controlamos si ya lo grabamos en esta session.
            if ($session->get('grabado_id') === NULL)
            {
                // Grabamos.
                $g  = $this->grabar($datos);
                $session->set('grabado_id',$g['id']);
                $id = $g['id'];
            }
            // Obtenemos los parametros configuracion del componente.
            $componentParams = $app->getParams('com_callcenter');
            $ruta = $componentParams->get('url_envio');
            // Ahora hacemos la peticion por curl
            $ch = curl_init($ruta);
            // Especificamos cabecera.
            
            //especificamos el POST (tambien podemos hacer peticiones enviando datos por GET
            curl_setopt ($ch, CURLOPT_POST, 1);
            
            //le decimos qué paramáetros enviamos (pares nombre/valor, también acepta un array)

            curl_setopt ($ch, CURLOPT_POSTFIELDS, $datos);
            //~ curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            //~ 'Content-Type: application/x-www-form-urlendcoded',
                                            //~ 'Content-Type: multipart/form-data' ));
             
            //le decimos que queremos recoger una respuesta (si no esperas respuesta, ponlo a false)
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


            //recogemos la respuesta
            $datos['curl'] = curl_exec ($ch);
            curl_close($ch); 
            // De momento no esta operativo el repetir.            
            $intentos = $session->get('intentos') + 1;
            $session->set('intentos',$intentos);
            // Si  fue correcta
            $obj = json_decode($datos['curl']);
            if  (isset($obj->_ok_title)){
                if ($obj->_ok_title ==='Ok'){
                    // Fue correcta la petición
                    $datos['estado'] ='Enviado';
                    if (!isset($id)){
                        // La petición fue correcta, pero nosotros no lo grabamos
                        // el motivo seguramente es porque con la misma
                        // session envio dos formularios.
                        $id = $session->get('grabado_id');
                        $datos['estado'] ='ReEnviado';
                    }
                    // El estado es 'Enviado'
                    $e = $this->cambioEstado($id, $datos['estado']);
                    $datos['res_estado'] =$e;
                }
            }
            if (isset($obj->code)){
                // El servidor responde, pero tuvo alguna incidencia.
                    // $obj->code ===50030 ;Error del servidor al enviar.. debemos volver enviarla.
                    // $obj->code ===40001 ;Indica que esta pendiente en el Call Center le llamara en breves.
                $datos['error'] = $obj->code;
            }
			$datos['id_grabado'] =$session->get('grabado_id');
            $datos['intentos'] =$session->get('intentos');
			$this->resultado = $datos;
            $this->resultado['ruta'] =$ruta;
            return $this->resultado;
			
	}

    public function grabar($datos){
        // grabamos por primera vez.
        			$db = JFactory::getDBO();
            // Grabamos en local antes de enviar.
             $query= "INSERT INTO #__callcenter (nombre,apellidos,telefono,observaciones,created,intentos) VALUES"
                    ."('".$datos['firstname']."',"
                    ."'".$datos['lastname']."',"
                    ."'".$datos['_customer_number']."',"
                    ."'".$datos['message']."',"
                    ."NOW(),"
                    ."'1')";
                $db->setQuery($query);
                $resul = $db->execute();
                $id = $db->insertid();
                $respuesta = array('sql'=>$query,'resul'=>$resul,'id'=>$id);
        return $respuesta;
    }
    public function cambioEstado($id,$estado,$intentos=0){
        $db = JFactory::getDBO();
        // Cambiamos el estado del id.
        $txtIntentos= '';
        if ($intentos >0){
            // Se manda este parametro cuando es un segundo intento.
            $txtIntentos = " AND intentos='".$intentos."'";
        }
            $query= "UPDATE #__callcenter SET `estado`='".$estado."' WHERE `id`='".$id."'".$txtIntentos;
        $db->setQuery($query);
        $resul = $db->execute();
        $respuesta = array('sql'=>$query,'resul'=>$resul);
    return $respuesta;

    }
	
}
