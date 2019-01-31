<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
//~ jimport('joomla.application.component.controller');

class CallcenterController extends JControllerLegacy
{	
	public $resultado; // Es donde quiero guardar el dato que envia el formulario	
	public function display($cachable = false, $urlparams = false)
	{
		/* Iniciamos variable */
		/* La variables $cachable y $ urlparams , si las imprimimos con 
		 * print_r siempre es 1 , ya que la ponemos en falso.
		 * Si le quito = false , da un error ya que no recibe parametro el display.
		 * */
		$cachable = true;
    	$input = JFactory::getApplication()->input;
         
		return parent::display($this);

	}
	public function submit()
	{
        // Llega aqui al pulsar en  enviar desde vista call center
        // Get the data from POST
		$this->resultado = JRequest::getVar('jform', array(), 'post', 'array');
        // Ahora comprobamos datos son correctos antes de enviar Call Center
        $session = JFactory::getSession();
        // Comprobamos si la session ya envio el formulario.
        if ($session->get('intentos'))
        {
            // Quiere decir que ya se mando el formulario .
            $intentos = $session->get('intentos') + 1;
            $session->set('intentos',$intentos);
        }  else {
            $session->set('intentos',1);
        }

        if ($session->get('grabado_id'))
        {
            // Ya se grabo, por lo que marcamos que es error.
            $this->resultado['estado']= 'Error';
            $this->resultado['error'] = 'Tiene que cerrar session, si quiere enviar otro';
            $aviso = array( 'type' => 'warning',
                        'texto'  => 'Error 1 submit: '.JText::_('COM_CALLCENTER_CREADA_PENDIENTE_LABEL')
                );
            JFactory::getApplication()->enqueueMessage($aviso['texto'], $aviso['type']);
        } else {
            // Solo compruebo datos si no esta grabado.
             $this->comprobarDatos();
        }
        if ($this->resultado['estado'] !== 'Error') {
            // No hay error en los datos.
            $this->set('view', 'respuesta');
            // Reseteamos intentos.
            $session->set('intentos',1);
        } else {
            $this->set('view', 'callcenter');

        }
    
		return ;
    }	

    public function repetir()
	{
        // Llega aquí cuando muestra pulsa boton repetir formulario.
        // Esto sucede cuando en una session se enviar formulario y quiere enviar otro.
        $session = JFactory::getSession();
        // Borramos datos session del componente.
        $session->clear('intentos');
        $session->clear('grabado_id');
        $this->set('view', 'callcenter');
        
        return;

        
    }
	public function comprobarDatos(){
        // Objetivo comprobar si los datos que envia son correctos.

        $expresion = '/^[9|6|7][0-9]{8}$/';
        if(preg_match($expresion, $this->resultado['_customer_number']))
        {
            $this->resultado['estado']= 'SinEnviar';
        }else{
            $this->resultado['estado']= 'Error';
            $this->resultado['error'] = 'Esta mal el telefono';
            $aviso = array( 'type' => 'warning',
                        'texto'  => 'Error en :'.$this->resultado['error']
                );
                JFactory::getApplication()->enqueueMessage($aviso['texto'], $aviso['type']);
        } 
        
        return ;
    }


    public function parametros(){
        // Obtenemos parametros del componente.
        $app = JFactory::getApplication();
        // Nosotros vamos comprobar si esta operativo el callCenter.
        // Obtenemos parametros del componente.
        $componentParams = $app->getParams('com_callcenter');

        return $componentParams;
    }

}


