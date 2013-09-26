$(function() {
  $( "#tagbox" ).click(function() {
    loader = cfg.baseUrl + "/img/ajax-loader.gif";
    $("#currentTags").html( "<img src='" + loader + "'>" );
	$form = $( "#mainForm" );
	entity = $form.attr( 'name' );	
    actionUrl = cfg.baseUrl + "/admin/" + entity + "/add/tag/step";
    value = $("input[name='currentTag']").val();  
    $.post( actionUrl, { 
      'tag': value },
        function( data ) {
          $( "#currentTags" ).empty().append( data );
          $("input[name='currentTag']").val('');	  
    });
  }); 
});

$(function() {
  $( ".deleteTag" ).live("click", function(e) {
    e.preventDefault();
    componentIndex=$(this).attr("name");
    loader = cfg.baseUrl + "/img/ajax-loader.gif";
    $("#currentTags").html( "<img src='" + loader + "'>" );
	$form = $( "#mainForm" );
	entity = $form.attr( 'name' );
	actionUrl = cfg.baseUrl + "/admin/" + entity + "/delete/tag/" + componentIndex;
    //alert(actionUrl);
    value = $("input[name='currentTag']").val();  
    $.post( actionUrl, { 
      'tag': componentIndex },
        function( data ) {
          $( "#currentTags" ).empty().append( data );
          $("input[name='currentTag']").val('');
    });
  });
});