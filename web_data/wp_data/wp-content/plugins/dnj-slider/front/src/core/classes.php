<?php
class Image {
    public $block_json;
    public $box_title;
    public $script_path;
    public $meta_field_id;

    public function __construct($box_id, $box_title, $script_path){
        $this->box_id = $box_id;
        $this->meta_field_id = $box_id.'_field';
        $this->box_title = $box_title;
        $this->script_path = $script_path;
    }

    public function render(){
        return '<div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="/wp-content/uploads/2024/04/img_snow_wide.jpg" style="width:100%"/>
        <div class="text">Caption Two</div>
      </div>'
    }
}

class Navigator {
    public $class_name

    public function __construct($class_name){
       $this->class_name = $class_name
    }

    public function render(){
        return  '<div class="' .$this->class_name. '"
        <div class="prev">&#10094;</div>
        <div class="next">&#10095;</div>
        </div>'
    }
}

class Indexer {
    public $n;
    public $class_name;
    public $type;

    public function __construct($n, $class_name, $type){
        $this->class_name = $class_name;
        $this->type = $type;
        $this->n = $n
    }

    public function render(){
        $res = '<div class="'.$this->class_name.'">'
        for ($i = 0; $i < $this->n; $i++) {
            $this->render_single_indexer($i);
          }

        $res += '</div>'
        return $res
    }

    private function render_single_indexer($ord){
        if ($ord == 0){
            $active = 'active'
        }
        else {
            $active = ''
        }
        return '<span class="' . $this->type . ' active"></span>'
    }
}

class Slider {
    public $block_json;
    public $box_title;
    public $script_path;
    public $meta_field_id;

    public function __construct($box_id, $box_title, $script_path){
        $this->box_id = $box_id;
        $this->meta_field_id = $box_id.'_field';
        $this->box_title = $box_title;
        $this->script_path = $script_path;
    }
}