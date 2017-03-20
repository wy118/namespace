<?php

namespace Wy_Namespace\Admin;

class Meta_Box {
  private $display;
  
  public function __construct($display) {
    $this->display = $display;
  }
  
  public function init() {
    add_meta_box(
      'wy-post-questions',
      'Inspiration Questions',
      array($this->display, 'render'),
      'post',
      'side',
      'high'
    );
  }
}