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
		$query = "CREATE TABLE "._DB_PREFIX_.$this->name." (`id_blocklink` int(2) NOT NULL AUTO_INCREMENT, `id_info` varchar(255), PRIMARY KEY (`id_blocklink`)) ENGINE="._MYSQL_ENGINE_." default CHARSET=utf8"; 
		$querytwo = "CREATE TABLE "._DB_PREFIX_.$this->name."_lang (`id_blocklink` int(2) NOT NULL AUTO_INCREMENT, `id_info` varchar(255), PRIMARY KEY (`id_blocklink`)) ENGINE="._MYSQL_ENGINE_." default CHARSET=utf8";       
		if(!parent::install() || $this->registerHook('header') == false || !Db::getInstance()->Execute($query) || !Db::getInstance()->Execute($querytwo)){
		return false;
		}
		else{
		return true;
		}
	}
	
	public function uninstall()
	{
			$query = "DROP TABLE "._DB_PREFIX_.$this->name;
			$querytwo = "DROP TABLE "._DB_PREFIX_.$this->name."_lang";
			if(!parent::uninstall() || !Db::getInstance()->Execute($query) || !Db::getInstance()->Execute($querytwo)){
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
			<legend><img src="'.$this->_path.'logo_stores.gif" /> This is some tab text</legend>
			<label>A label</label><input type="submit" class="button" />
		</fieldset><fieldset class="space">'; 
		$links = $this->getLinks();
		foreach($links as $link){
			$this->_html .= '<p>'.$link['id'].'<br />'.$link['url'].'<br />'.$link['newWindow'].'<br /></p>';
		}
		$this->_html .= '</fieldset>';
	}
	
	public function getLinks(){
		$result = array();
		/* get id and url */
		if (!$links = Db::getInstance()->ExecuteS('SELECT `id_blocklink`, `url`, `new_window` FROM '._DB_PREFIX_.'blocklink'.((int)(Configuration::get('PS_BLOCKLINK_ORDERWAY')) == 1 ? ' ORDER BY `id_blocklink` DESC' : '')))
			return false;
		$i = 0;
		foreach ($links AS $link)
		{	
			$result[$i]['id'] = $link['id_blocklink'];
			$result[$i]['url'] = $link['url'];
			$result[$i]['newWindow'] = $link['new_window'];
			/* Get multilingual text */
			if (!$texts = Db::getInstance()->ExecuteS('SELECT `id_lang`, `text` FROM '._DB_PREFIX_.'blocklink_lang WHERE `id_blocklink`='.(int)($link['id_blocklink'])))
				return false;
			foreach($texts AS $text)
				$result[$i]['text_'.$text['id_lang']] = $text['text'];
			$i++;
		}
		return $result;
	}
	
	public function addLink(){
		
	}
	
	public function updateLink(){
		
	}
	
	public function deleteLink(){
		
	}
	
	public function hookHeader($params){
		global $smarty;
		$smarty->assign(array(
				'jslink' => $this->_path."debug.js"
		));
		Tools::addJS($this->_path."debug.js");
		return $this->display(__FILE__, 'header.tpl');
	}
}