<?php

// No direct access
defined('_JEXEC') or die;
//~ jimport('joomla.application.component.modelform');
//~ echo '<br/>Entro en modelo codigorecibo.php<br/>';

class CallcenterModelCallcenter extends JModelForm
{
		protected $view_item = 'callcenter';
	
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_callcenter.callcenter', 'callcenter', array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		
		return $form;
	}
	
	protected function loadFormData()
	{
        $app = JFactory::getApplication();
        $data = (array)$app->getUserState('com_callcenter.callcenter.data', array());
		// Llegamos aquí al antes de getForm
        // El array data esta vacio.
		// No se realmente que hace
		return $data;
	}

    public function getComprobar()
    {
        $app = JFactory::getApplication();
        // Nosotros vamos comprobar si esta operativo el callCenter.
        // Obtenemos parametros del componente.
        $componentParams = $app->getParams('com_callcenter');
        $ruta = $componentParams->get('url_comprobar');

        $ch = curl_init($ruta);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//enviamos el array data
		//obtenemos la respuesta
		$response = curl_exec($ch);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($ch);
        $data = array();
        if(!$response) {
            $data['error'] = JText::_('COM_CALLCENTER_ERRORCONEXION_LABEL');
        } else {
            // Compruebo si la respuesta nos indica que esta fuera horario.
            $obj = json_decode($response);
            if ($obj->open_for === '00:00'){
                // Si la consulta fue correcta, pero esta fuera de horario.
                $data['error'] = JText::_('COM_CALLCENTER_FUERAHORARIO_LABEL');
            }
            $data['respuesta'] =$response;
        }
        return $data;
    }
	
}
