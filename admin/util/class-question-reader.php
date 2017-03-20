<?php

namespace Wy_Namespace\Admin\Util;

class Question_Reader {
  public function get_question_from_file( $filename ) {
 
      $question = '';
 
      $file_handle = $this->open( $filename );
      $question    = $this->get_random_question( $file_handle, $filename );
 
      $this->close( $file_handle );
 
      return $question;
  }
  
  private function open( $filename ) {
      return fopen( $filename, 'r' );
   }
   
  private function close( $file_handle ) {
      fclose( $file_handle );
   }
   
  private function get_random_question( $file_handle, $filename ) {
 
      $questions = fread( $file_handle, filesize( $filename ) );
      $questions = explode( "\n", $questions );
 
      // Look for a question until an empty string is no longer returned.
      $question = $questions[ rand( 0, 75 ) ];
      while ( empty( $question ) ) {
         $question = $questions[ rand( 0, 75 ) ];
      }
 
      return $question;
    }
}