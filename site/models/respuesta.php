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
            if ($session->get('grabado') === NULL)
            {
                // Grabamos.
                $g  = $this->grabar($datos);
                echo '<pre>';
                echo 'Grabar';
                echo print_r($g);
                echo '</pre>';
                $session->set('grabado',$g['resul']);
                $id = $g['resul']['id'];
            }
            // Ahora hacemos la peticion por curl
            $componentParams = $app->getParams('com_callcenter');
            $ruta = $componentParams->get('url_envio');
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
            if  (isset($datos['_ok_title'])){
                if ($datos['_ok_title'] ==='Ok'){
                // Fue correcta la petición el estado es 'Enviado'
                    $e = $this->cambioEstado($id,'Enviado');
                    echo '<pre>';
                    echo 'Cambio estado';
                    echo print_r($e);
                    echo '</pre>';
                }
            }
			$datos['session'] =$session->get('grabado');
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
    public function cambioEstado($id,$estado){
        // grabamos por primera vez.
        			$db = JFactory::getDBO();
            // Grabamos en local antes de enviar.
             $query= "UPDATE #__callcenter` SET `estado`='".$estado."' WHERE `id`='".$id."'";
                $db->setQuery($query);
                $resul = $db->execute();
                $respuesta = array('sql'=>$query,'resul'=>$resul);
    return $respuesta;

    }
	
}
