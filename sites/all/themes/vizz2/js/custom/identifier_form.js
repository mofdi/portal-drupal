  $(function() {
  $( "#identifierbox" ).click(function() {
    loader = cfg.baseUrl + "/img/ajax-loader.gif";
    $("#currentIdentifiers").html( "<img src='" + loader + "'>" );
	$form = $( "#mainForm" );
	entity = $form.attr( 'name' );	
    actionUrl = cfg.baseUrl + "/admin/" + entity + "/add/identifier/step";
    type = $("select[name='identifierType']").val();  
	value = $("input[name='identifierIdentifier']").val();
    $.post( actionUrl, { 
      'identifier.type': type,
	  'identifier.identifier': value },
        function( data ) {
          $( "#currentIdentifiers" ).empty().append( data );
          $("select[name='identifierType']").val('');	  
		  $("input[name='identifierIdentifier']").val('');
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