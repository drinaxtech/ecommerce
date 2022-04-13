<?php
    namespace Core;
    
    class View {
        protected $_head, $_body, $_footer, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

        public function __construct(){
        }

        public function render($viewName, $data = [], $layout = DEFAULT_LAYOUT){
            $viewArr = explode('/', $viewName);
            $this->_layout = $layout;
            $viewString = implode(DS, $viewArr);
            extract($data);
            if(file_exists(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php')){
                require(ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php');
                require(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->_layout . '.php');
            } else {
                die('The view \"' . $viewName . '\" does not exist.');
            }
        }
        
        public function content($type){
            switch($type){
                case 'head': 
                    return $this->_head;
                case 'body':
                    return $this->_body;
                case 'footer':
                    return $this->_footer;
                default:
                    return false;
            }

        }


        public function start($type){
            $this->_outputBuffer = $type;
            ob_start();
        }

        public function end(){
            if($this->_outputBuffer == 'head'){
                $this->_head = ob_get_clean();
            } else if($this->_outputBuffer == 'body'){
                $this->_body = ob_get_clean();
            }  else if($this->_outputBuffer == 'footer'){
                $this->_footer = ob_get_clean();
            } else {
                die('You must first run the start method.');
            }
        }

        public function siteTitle(){
            return $this->_siteTitle;
        }

        public function setSiteTitle($title){
            $this->_siteTitle = $title;
        }

        public function setLayout($path){
            $this->_layout = $path;
        }

        public function insert($path){
            include ROOT . DS . 'app' . DS . 'views' . DS . $path . '.php';
        }
      
        public function partial($group, $partial){
            include ROOT . DS . 'app' . DS . 'views' . DS . $group . DS . 'partials' . DS . $partial . '.php';
        }
      

    }