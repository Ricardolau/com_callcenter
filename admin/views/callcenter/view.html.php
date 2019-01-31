<?php
defined( '_JEXEC') or die( 'Restricted access');
jimport( 'joomla.application.component.view');
//~ 
 //~ echo '<pre>';
 //~ print_r($this);
 //~ echo '</pre>';
 
//nomenclatura : nombreComponente+View+nombreVista
class CallcenterViewCallcenter extends JViewLegacy
{
	
	function display($tpl = null)
	{
		//es necesario establecerlos para poder usarlos en default...
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		
			//check errores
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		$this->addToolbar();
		
		//si la funcion toolbar la tienes en MODELS se llamaria  asi:
		//añadimos titulo componente y btnes añadir, editar..
		//~ $toolbar = $model->addToolbar();
		//~ $this->assignRef('addToolbar', $toolbar);
		
		
		parent::display($tpl);
	}
	
	function addToolbar()
	{
				//intencion AÑADIR menu Toolbar btnes añadir, editar..
	 JToolBarHelper::title( 'Call Center ', 'callcenter.png' );
     JToolBarHelper::addNew('vista.add');
     JToolBarHelper::editList('vista.edit');     
     
     //----- nuevo es cambiado por => codigorecibo -----------//
     //AVISO!! btn borrar no necesita otra vista por eso al quedarse en la vista
     //general (nuevo) va al controlador de nuevo (nuevo.delete) y en el controlador
     //de nuevo va al modelo de la vista (singular) pork es alli dnde estan las 
     //funciones de getTable, getForm, loadFormData..
     JToolBarHelper::deleteList('Seguro de eliminar este registro?','callcenter.delete', 'JTOOLBAR_DELETE');
     JToolBarHelper::preferences('com_callcenter', '500');	
	}
	
 
}
