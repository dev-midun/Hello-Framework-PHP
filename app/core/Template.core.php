<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);

class Template {
    private $css = array();
    private $js = array();
    private $content;

    /**
     * Method layout
     * Render content to admin template
     * @param {string} content path content in folder view
     * @param {object} config default null
     *                  conifg.css {array}
     *                  config.js {array of object}
     *                      js.src {string}
     *                      js.type {string} if empty or not isset, default is script js basic
     * @param {array} data default null, parsing var to content
     */
    public function layout($content, $config = null, $data = null) {
        ob_start();

        $this->content = $content;

        $__css = $__js = '';
        $__header = $this->getHeader();
        $__sidebar = $this->getSidebar();
        $__footer = $this->getFooter();
        $__content = $this->getContent();

        if(!empty($data)) {
            foreach($data as $key => $value) {
                ${$key} = $value;
            }
        }

        if(!empty($config)) {
            if(isset($config->css) && !empty($config->css)) {
                foreach($config->css as $item) {
                    $this->addCSS($item);
                }
                $__css = $this->getCSS();
            }

            if(isset($config->js) && !empty($config->js)) {
                foreach($config->js as $item) {
                    $this->addJS($item);
                }
                $__js = $this->getJS();
            }
        }

        require_once VIEW. '_Layout' .DS. 'layout.php';

        $layout = ob_get_contents();
        ob_end_clean();

        echo $layout;
        die();
    }

    private function addCSS($cssPath) {
        $this->css[] = $cssPath;
    }
    
    private function addJS($js) {
        $this->js[] = (object)array(
            'src' => $js->src,
            'type' => isset($js->type) && !empty($js->type) ? $js->type : null
        );
    }
    
    private function getCSS() {
        $css = '';
        foreach ($this->css as $value) {
            $css .= '<link rel="stylesheet" href="'.BASE_URL.$value.'">'."\n";
        }
        
        return $css;
    }
    
    private function getJS() {
        $js = '';
        foreach ($this->js as $value) {
            $js .= '<script' .($value->type ? ('type="' .$value->type. '"') : ''). ' src="'.BASE_URL.$value->src.'"></script>'."\n";
        }

        return $js;
    }

    private function getHeader() {
        ob_start();
        require_once VIEW. '_Layout' .DS. 'template' .DS. 'header.php';
        $header = ob_get_contents();
        ob_end_clean();

        return $header;
    }

    private function getSidebar() {
        ob_start();
        require_once VIEW. '_Layout' .DS. 'template' .DS. 'sidebar.php';
        $sidebar = ob_get_contents();
        ob_end_clean();

        return $sidebar;
    }

    private function getFooter() {
        ob_start();
        require_once VIEW. '_Layout' .DS. 'template' .DS. 'footer.php';
        $footer = ob_get_contents();
        ob_end_clean();

        return $footer;
    }

    private function getContent() {
        ob_start();

        $temp = explode('/', $this->content);
        $viewPath = '';
        for($i=0; $i<count($temp); $i++){
            if((count($temp)-$i != 1)) {
                $viewPath .= $temp[$i].DS;
            }
            else {
                $viewPath .= $temp[$i];
            }
        }

        require_once VIEW.$viewPath. '.php';
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}