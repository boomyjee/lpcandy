<?php

namespace LPCandy\Controllers\Admin;

class Developer extends \CMS\Controllers\Admin\BasePrivate {
    function create_bg_thumbs() {
        foreach (glob(INDEX_DIR."/view/editor/assets/background/*.jpg") as $path) {
            $file = \PhpThumb\Factory::create($path,array('resizeUp'=>false));
            $file->resize(200,1000);
            $file->save(INDEX_DIR."/view/editor/assets/background/thumbs/".basename($path));
        }
        echo 'ok';
    }
    
    function build() {
        
        if (isset($_POST['js'])) {
            
            $js = $_POST['js'];
            $css = $_POST['css'];
            
            $postdata = array('http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( array('input' => $js) ) ) );
            $minified = file_get_contents('http://javascript-minifier.com/raw', false, stream_context_create($postdata));
            file_put_contents(INDEX_DIR."/view/editor/editor.min.js",$minified);

            $postdata = array('http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query( array('input' => $css) ) ) );
            $minified = file_get_contents('http://cssminifier.com/raw', false, stream_context_create($postdata));
            file_put_contents(INDEX_DIR."/view/editor/editor.min.css",$minified);
            echo 'done';
            die();
        }

        ?>
        <script src="/~boomyjee/teacss-ui/lib/teacss-ui.js"></script>
        <script src="/~boomyjee/dayside/client/lib/require.js"></script>
        
        <script>
            require.build(
                "/~boomyjee/templater/lib/client/app.js",
                "<?=url('view/editor/editor.js')?>",
                function (res) {
                    console.debug(res.js);
                    $("body").text('minifying');
                    $.ajax({
                        url: "",
                        type: "POST",
                        data: {js:res.js,css:res.css},
                        success: function (data) {
                            $("body").text(data);
                        }
                    });
                }
            );
        </script>        

        
    <?}
    
    function create_translations() {
        $dir = INDEX_DIR."/view/editor";
        
        $Directory = new \RecursiveDirectoryIterator($dir);
        $Iterator = new \RecursiveIteratorIterator($Directory);
        $Regex = new \RegexIterator($Iterator, '/^.+\.js$/i', \RecursiveRegexIterator::GET_MATCH);
        
        $lines = array();
        
        foreach ($Regex as $path) {
            $text = file_get_contents($path[0]);
            preg_match_all('/_t\(("([^"]+)"|\'([^\']+)\')\)/',$text,$matches);
            
            if (!empty($matches[0])) {
                foreach ($matches[2] as $i=>$line) {
                    if (!$line) $line = $matches[3][$i];
                    if ($line) $lines[$line] = $line;
                }
            }
        }
        
        $ru_path = $dir."/editor_ru.js";
        $translated = @file_get_contents($ru_path);
        $translated = $translated ? json_decode(str_replace("exports = ","",$translated),true) : array();
        
        $new_translated = array();
        foreach ($lines as $line) {
            $new_translated[$line] = isset($translated[$line]) ? $translated[$line] : '';
        }
        
        $text = json_encode($new_translated);
        $text = str_replace("{","exports = {\n    ",$text);
        $text = str_replace("\",","\",\n    ",$text);
        $text = str_replace("}","\n}",$text);
        
        $text = preg_replace_callback('/\\\\u(\w{4})/', function ($matches) {
            return html_entity_decode('&#x' . $matches[1] . ';', ENT_COMPAT, 'UTF-8');
        }, $text);        
        
        file_put_contents($ru_path,$text);
        
        _D($new_translated);
    }
}