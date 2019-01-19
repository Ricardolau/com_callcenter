<?php
// No direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_newsfeeds
 */
 //~ echo '<br/> estoy en TABLES--> vista.php ';
class CallcenterTableVista extends JTable
{
	/**
	 * Constructor
	 *
	 * @param JDatabase A database connector object
	 * y guardar los registros en bbdd
	 */
	public function __construct(&$db)
	{
		 //~ echo '<br/> Tables-> vista.php -> constructor	  ';
		 //~ echo '<br/> bd '.(int)$db;
		 //~ echo '<br/> ************************************************************** <br/>';
	        //~ echo '<pre>';
          //~ print_r($this);
     //~ echo '</pre>';
		
		parent::__construct('#__callcenter', 'id', $db);
	}


/**
	 * Overriden JTable::store to set modified data and user id.
	 *
	 * @param	boolean	True to update fields even if they are null.
	 * @return	boolean	True on success.
	 * @since	1.6
	 */
	public function store($updateNulls = false)
	{
		$date	= JFactory::getDate();
		if ($this->id)
		{
			// Existing item
			$this->modified		= $date->toSql();
			
		} 
		else 
		{	// Un campo de alimentación creada y created_by se puede ajustar por el usuario,
							// Por lo que no tocamos cualquiera de ellos si están ajustados .
				if (!intval($this->created)) {
				$this->created = $date->toSql();
			}
		}
		
		
		/////////////////////////////////////////////////////////////////////////////
		/*		COMPROBAR QUE EL CODIGO al editar NO SE REPITA EN LA BBDD	*/
		$table = JTable::getInstance('Vista', 'CallcenterTable');
        
		//~ if  ($table->load(array('numeroParticipacion'=>$this->numeroParticipacion)) && ($table->numeroParticipacion != $this->numeroParticipacion || $this->numeroParticipacion==0)) {
			//~ $this->setError('El numero de participación no se puede repetir');//JText::_('COM_WEBLINKS_ERROR_UNIQUE_ALIAS'));
			
			//~ return false;
		//~ }
		/////////////////////////////////////////////////////////////////////////
		return parent::store($updateNulls);
	}
	

}
