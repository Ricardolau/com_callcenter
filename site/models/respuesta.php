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
			$envio = $data['jform'];
			
			
			$db = JFactory::getDBO();
            // Aquí podría comprobar que si existe el telefono y estado está..
            // Si esta en ok , era guapo que le preguntará si le llamaron o no.. para cambiar el estado.. jeje
            
			//~ $query = "SELECT * FROM #__callcenter "
					//~ ."WHERE numeroParticipacion ='".$numeroParticipacion."' AND cantidadJugada ='".$cantidadJugada."'";
			//~ $db->setQuery($query);
			//~ $resul =  $db->loadObjectList();
			$resul['algo'] = 'Envio algo ahora';
			

			
			$this->resultado = $resul;
			return $this->resultado;
			
	}
	
}
