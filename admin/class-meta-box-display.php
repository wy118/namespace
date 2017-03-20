<?php

namespace Wy_Namespace\Admin;

class Meta_Box_Display {
  private $question_reader;
  
  public function __construct( $question_reader ) {
        $this->question_reader = $question_reader;
    }
  /**
    * Renders a single string in the context of the meta box to which this
   * Display belongs.
   */
  public function render() {
    $file = dirname( __FILE__ ) . '/data/questions.txt';
        $question = $this->question_reader->get_question_from_file( $file );
 
        echo wp_kses( $question, false);
  }
}