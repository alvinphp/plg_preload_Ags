<?php
/**
* Developer: Alvin Gil Saldaña
* @copyright	Copyright (c) 2024. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */


use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
// no direct access
defined('_JEXEC') or die;
class plgsystemPreloadAgs extends JPlugin {
  protected $app;

  function onAfterRender()
  {
$app = JFactory::getApplication();
 // validando lado cliente
if ($app->isClient("administrator")) {
         return;
  }
$body = $this->app->getBody();
// html
$html='<div class="fakeLoader"></div>';
 $body = str_replace('</body>',  $html .'</body>', $body );
 $this->app->setBody($body);
}

// fin Evento
function onBeforeRender(){
  $doc = JFactory::getDocument();
  // params
  $fontcolor = $this->params->get('font');
  $style = $this->params->get('style');
  $doc->addScript('plugins/system/preloadags/assets/js/fakeLoader.min.js');
  $doc->addStyleSheet('plugins/system/preloadags/assets/css/fakeLoader.min.css');
  JHtml::_('jquery.framework');
// add jquery
  $doc->addScriptDeclaration("

  $(document).ready(function () {
      $.fakeLoader({
          bgColor: '$fontcolor',
          spinner:'$style'
      });
  });
");

}
  }
