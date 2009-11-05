<?php
/**
 * Plugin Picasa web album: Create Picasa web album
 *
 * @license    GPL v3 (http://www.gnu.org/licenses/gpl.html)
 * @author     Christophe Benz
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_jquery_picasawebalbum extends DokuWiki_Syntax_Plugin {
  function getInfo(){
    return array(
      'author' => 'Christophe Benz',
      'email'  => 'cbenz _AT_ easter-eggs _DOT_ com',
      'date'   => '2008-12-08',
      'name'   => 'Picasa web album plugin',
      'desc'   => 'Create Javascript Picasa web album from its name.',
      'url'    => 'http://www.dokuwiki.org/plugin:picasawebalbum',
    );
  }

  function getType() { return 'substition'; }
  function getSort() { return 159; }

  function connectTo($mode) {
    $this->Lexer->addSpecialPattern('\{\{picasawebalbum>[^}]*\}\}', $mode, 'plugin_jquery_picasawebalbum');
  }

  function handle($match, $state, $pos, &$handler){
    $params = substr($match, strlen('{{picasawebalbum>'), - strlen('}}') ); // Strip markup
    return array($state, explode(':', $params));
  }	

  function render($mode, &$renderer, $data) {
    if($mode == 'xhtml'){
      list($state, $params) = $data;
      list($user_name, $album_name) = $params;

      $regex = '/^[\w-_]+$/';
      if(preg_match($regex, $user_name) == 0) {
        $renderer->doc .= 'Error: Picasa user name must be alphanumeric. Given value: ' . htmlentities($user_name);
        return false;
      }

      if(isset($album_name)) {
        if(preg_match($regex, $album_name) == 0) {
          $renderer->doc .= 'Error: Picasa album name must be alphanumeric. Given value: ' . htmlentities($album_name);
          return false;
        }
      }

      $div_id = strtolower('picasawebalbum-' . $user_name . '-' . $album_name);

      $mode = isset($album_name) ? 'album' : 'albums';
      $album = isset($album_name) ? $album_name : '';

      $html = <<<EOHTML
<div id="$div_id"></div>
<script type="text/javascript">
on_document_ready('$div_id', '$user_name', '$mode', '$album');
</script>
EOHTML;

      $renderer->doc .= $html;

      return true;
    }
    return false;
  }
}
?>
