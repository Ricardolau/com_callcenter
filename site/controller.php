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
		//programar una vista por defecto si no se establece
    	$input = JFactory::getApplication()->input;
        // Aquí puedo comprobar si ya envio el formulario y si ...
       
            
		return parent::display($this);

	}
	public function submit()
	{
        // Llega aqui al pulsar en  enviar desde vista call center
        //~ $input = JFactory::getApplication()->input;

		//~ // Get the data from POST
		$this->resultado = JRequest::getVar('jform', array(), 'post', 'array');
        // Ahora comprobamos datos son correctos antes de enviar Call Center
        $this->comprobarDatos();
        if ($this->resultado['estado'] !== 'Error') {
            $this->set('view', 'respuesta');
        }
    
		return ;
    }	

    	

	public function comprobarDatos(){
        // Objetivo comprobar si los datos que envia son correctos.

        $expresion = '/^[9|6|7][0-9]{8}$/';
        if(preg_match($expresion, $this->resultado['_customer_number']))
        {
            $this->resultado['estado']= 'SinEnviar';
        }else{
            $this->resultado['estado']= 'Error';
        } 
        
        return ;
    }


}
