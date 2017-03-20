<?php

/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin.
 *
 * @package Wy_Namespace_Demo\Inc
 */
 
spl_autoload_register( 'wy_namespace_autoload' );

function wy_namespace_autoload( $class_name ) {
    // If the specified $class_name does not include our namespace, duck out.
    if ( false === strpos( $class_name, 'Wy_Namespace' ) ) {
        return;
    }
 
    $file_parts = explode( '\\', $class_name );
    
    $namespace = '';
    for ( $i = count( $file_parts ) - 1; $i > 0; $i-- ) {
      $current = strtolower( $file_parts[ $i ] );
      $current = str_ireplace( '_', '-', $current );
      
      if ( count( $file_parts ) - 1 === $i ) {
 
        /* If 'interface' is contained in the parts of the file name, then
     * define the $file_name differently so that it's properly loaded.
     * Otherwise, just set the $file_name equal to that of the class
     * filename structure.
     */
      if ( strpos( strtolower( $file_parts[ count( $file_parts ) - 1 ] ), 'interface' ) ) {
 
        // Grab the name of the interface from its qualified name.
          $interface_name = explode( '_', $file_parts[ count( $file_parts ) - 1 ] );
          $interface_name = $interface_name[0];
  
          $file_name = "interface-$interface_name.php";
  
      } else {
          $file_name = "class-$current.php";
      }
      } else {
        $namespace = '/' . $current . $namespace;
      }
    }
    
    $filepath  = trailingslashit( dirname( dirname( __FILE__ ) ) . $namespace );
    $filepath .= $file_name;
    if ( file_exists( $filepath ) ) {
      include_once( $filepath );
  } else {
      wp_die(
          esc_html( "The file attempting to be loaded at $filepath does not exist." )
      );
  }
}