<?php
/*
* 2011 Media City Online 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to truemedia@mediacityonline.net so we can send you a copy immediately.
*
*  @author Wade Penistone <truemedia@mediacityonline.net>
*  @copyright  2011 Wade Penistone
*  @version  Release: $Revision: 1.0 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of Media City Online
*/

if (!defined('_CAN_LOAD_FILES_'))
	exit;
	
class PdfCustomizer extends Module
{
	/* @var boolean error */
	protected $error = false;
	
	public function __construct()
	{
		$this->name = 'pdfcustomizer';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Wade Penistone';
		
		parent::__construct();
		
		$this->displayName = $this->l('PDF Customizer');
		$this->description = $this->l('This is a description of nothing specific apart from this module');
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');
	}
	
	public function install()
	{     
			if(!parent::install()){
			return false;
			}
			else{
			return true;
			}
	}
	
	public function uninstall()
	{
			if(!parent::uninstall()){
			return false;
			}
			else{
			return true;
			}
	}
	public function getContent(){
		$this->_html = "<h2>".$this->displayName."</h2>";
	
		$this->_displayForm();
	
		return $this->_html;
	}
	public function _displayForm(){
		$this->_html .= '
		<fieldset class="space">
			<legend><img src="http://www.google.co.uk/intl/en_com/images/srpr/logo1w.png" /> This is some tab text</legend>
			<label>A label</label><input type="submit" class="button" />
		</fieldset>';
	}
}