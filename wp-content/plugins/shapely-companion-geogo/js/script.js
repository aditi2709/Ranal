(function( $ ) {// jscs:ignore validateLineBreaks
  'use strict';
  $( document ).ready( function() {
    $( '.feature-list' ).cloneya().on( 'after_append.cloneya after_delete.cloneya', function( toClone, newClone ) {
      let index = 0;
      let attrname = $( this ).find( 'input:first' ).attr( 'name' );
      let attrbase = attrname.substring( 0, attrname.indexOf( '][' ) + 1 );
      let attrid = $( this ).find( 'input:first' ).attr( 'id' );
      // let attrbase =  attrname.substring( 0, attrname.indexOf( '][' ) + 1 ); //'widget-scout_features_plugin[2]';
      console.log("attrbase", attrbase);
      $('.feature-list').find( 'li' ).each( function() {
        $( this ).find( '.feature-title' ).attr( 'id', 'feature-title-' + index ).attr( 'name', attrbase + '[feature][title]' + '[' + (index-1) + ']' ).trigger( 'change' );
        $( this ).find( '.feature-icon' ).attr( 'id', 'feature-icon-' + index ).attr( 'name', attrbase + '[feature][icon]' + '[' + (index-1) + ']' ).trigger( 'change' );
        $( this ).find( '.feature-description' ).attr( 'id', 'feature-description-' + index ).attr( 'name', attrbase + '[feature][description]' + '[' + (index-1) + ']' ).trigger( 'change' );
        index++;
      });
    });

  });
})( jQuery );
