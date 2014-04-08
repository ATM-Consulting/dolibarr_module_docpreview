<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2013 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * 	\defgroup	DocPreview	DocPreview module
 * 	\brief		DocPreview module descriptor.
 * 	\file		core/modules/modDocPreview.class.php
 * 	\ingroup	DocPreview
 * 	\brief		Description and activation file for module DocPreview
 */
include_once DOL_DOCUMENT_ROOT . "/core/modules/DolibarrModules.class.php";

/**
 * Description and activation class for module DocPreview
 */
class modDocPreview extends DolibarrModules
{

    /**
     * 	Constructor. Define names, constants, directories, boxes, permissions
     *
     * 	@param	DoliDB		$db	Database handler
     */
    public function __construct($db)
    {
        global $langs, $conf;

        $this->db = $db;

        // Id for module (must be unique).
        // Use a free id here
        // (See in Home -> System information -> Dolibarr for list of used modules id).
        $this->numero = 104070; // 104000 to 104999 for ATM CONSULTING
        // Key text used to identify module (for permissions, menus, etc...)
        $this->rights_class = 'DocPreview';

        // Family can be 'crm','financial','hr','projects','products','ecm','technic','other'
        // It is used to group modules in module setup page
        $this->family = "technic";
        // Module label (no space allowed)
        // used if translation string 'ModuleXXXName' not found
        // (where XXX is value of numeric property 'numero' of module)
        $this->name = preg_replace('/^mod/i', '', get_class($this));
        // Module description
        // used if translation string 'ModuleXXXDesc' not found
        // (where XXX is value of numeric property 'numero' of module)
        $this->description = "Preview for PDF attached in attachments";
        // Possible values for version are: 'development', 'experimental' or version
        $this->version = '1.1';
        // Key used in llx_const table to save module status enabled/disabled
        // (where DocPreview is value of property name of module in uppercase)
        $this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);
        // Where to store the module in setup page
        // (0=common,1=interface,2=others,3=very specific)
        $this->special = 2;
        // Name of image file used for this module.
        // If file is in theme/yourtheme/img directory under name object_pictovalue.png
        // use this->picto='pictovalue'
        // If file is in module/img directory under name object_pictovalue.png
        // use this->picto='pictovalue@module'
        $this->picto = 'docpreview@docpreview'; // mypicto@DocPreview
        // Defined all module parts (triggers, login, substitutions, menus, css, etc...)
        // for default path (eg: /DocPreview/core/xxxxx) (0=disable, 1=enable)
        // for specific path of parts (eg: /DocPreview/core/modules/barcode)
        // for specific css file (eg: /DocPreview/css/DocPreview.css.php)
       
        // Data directories to create when module is enabled.
        // Example: this->dirs = array("/DocPreview/temp");
        $this->dirs = array();

        // Config pages. Put here list of php pages
        // stored into DocPreview/admin directory, used to setup module.
        $this->config_page_url = false;

        // Dependencies
        // List of modules id that must be enabled if this module is enabled
        $this->depends = array();
        // List of modules id to disable if this one is disabled
        $this->requiredby = array();
        // Minimum version of PHP required by module
        $this->phpmin = array(5, 0);
        // Minimum version of Dolibarr required by module
        $this->need_dolibarr_version = array(3, 3);
		$this->langfiles = array("docpreview@docpreview"); // langfiles@mymodule
        // Constants
        // List of particular constants to add when module is enabled
        // (key, 'chaine', value, desc, visible, 'current' or 'allentities', deleteonunactive)
        // Example:
	$this->const=array();     


     	$this->module_parts = array(
				'js' => array('/docpreview/js/docpreview.js.php')
		);
       
    }

    /**
     * Function called when module is enabled.
     * The init function add constants, boxes, permissions and menus
     * (defined in constructor) into Dolibarr database.
     * It also creates data directories
     *
     * 	@param		string	$options	Options when enabling module ('', 'noboxes')
     * 	@return		int					1 if OK, 0 if KO
     */
    public function init($options = '')
    {
        $sql = array();

        $result = $this->loadTables();


        return $this->_init($sql, $options);
    }

    /**
     * Function called when module is disabled.
     * Remove from database constants, boxes and permissions from Dolibarr database.
     * Data directories are not deleted
     *
     * 	@param		string	$options	Options when enabling module ('', 'noboxes')
     * 	@return		int					1 if OK, 0 if KO
     */
    public function remove($options = '')
    {
        $sql = array();

        return $this->_remove($sql, $options);
    }

    /**
     * Create tables, keys and data required by module
     * Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
     * and create data commands must be stored in directory /DocPreview/sql/
     * This function is called by this->init
     *
     * 	@return		int		<=0 if KO, >0 if OK
     */
    private function loadTables()
    {
        return $this->_load_tables('/docpreview/sql/');
    }
}
