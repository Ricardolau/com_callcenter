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
			
			//~ $envio = JRequest::getVar('jform', array(), 'get', 'array');
			// JRequest en las versiones superiores de 3.3 se dejaron... 
			$jinput = JFactory::getApplication()->input; 
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
                $session->set('grabado',$g['resul']);
            }
            // Ahora hacemos la peticion por curl
            //~ $ruta = 'http://homer.superoliva.es/beta/Php/Ejemplo_Api-php/enServidor/recibirPost.php';

            $ruta = 'https://cx.bosch-so.com/ence-callback';

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
            //~ echo '<pre>';
            //~ echo 'Despues de curl';
            //~ print_r($datos);
            //~ echo '<pre>';
            // Como ya hizo los proceso y no vuelva a grabar lo que hacemos es añadir 1 el contador intentos.
            
            $intentos = $session->get('intentos') + 1;
            $session->set('intentos',$intentos);
            
			
			$this->resultado = $datos;
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
                    ."'".$datos['observaciones']."',"
                    ."NOW(),"
                    ."'1')";
                $db->setQuery($query);
                $resul = $db->execute();
                $respuesta = array('sql'=>$query,'resul'=>$resul);
        return $respuesta;

    }
	
}
