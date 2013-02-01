$(function() {
  $( "#dialog-contact" ).dialog({
    autoOpen: false,
    height: 700,
    width: 650,
    modal: true,
    buttons: {
      "Submit": function() {
	  var modalWindow= $( this );
      var $form = $( "#contactForm" ),
        url = $form.attr( 'action' );
		firstName = $("input[name='contact.firstName']").val();
		lastName = $("input[name='contact.lastName']").val();
		email = $("input[name='contact.email']").val();
		type = $("select[name='contact.type']").val();
		country = $("select[name='contact.country']").val();
		salutation = $("input[name='contact.salutation']").val();
		position = $("input[name='contact.position']").val();
		description = $("input[name='contact.description']").val();
		address = $("input[name='contact.address']").val();
		city = $("input[name='contact.city']").val();
		province = $("input[name='contact.province']").val();
		postalCode = $("input[name='contact.postalCode']").val();
		phone = $("input[name='contact.phone']").val();
		onlineUrl = $("input[name='contact.onlineUrl']").val();
        /* Send the data via jquery post and if errors are present, keep them on the same modal dialog */
        $.post( url, { 'contact.firstName': firstName, 
                       'contact.lastName': lastName,
                       'contact.email': email,
					   'contact.type': type,
					   'contact.salutation': salutation,
					   'contact.position': position,
					   'contact.description': description,
					   'contact.address': address,		
					   'contact.city': city,
					   'contact.province': province,
					   'contact.postalCode': postalCode,
					   'contact.type': type,		
					   'contact.phone': phone,	
					   'contact.onlineUrl': onlineUrl },
        function( data ) {
		  //find whether the data returned contains the <div id="contactSuccess"/>
		  //if not, the form didn't validate and the original form is displayed again
		  success = $(data).find("div#contactSuccess").size();
		  if(success>0) {
            $( "#entityContacts" ).empty().append( data );
			$( modalWindow ).dialog( "close" );
		  }
		  else {
            $( "#newone" ).empty().append( data );		  
          }  
        });
      },
      Close: function() {
        $( this ).dialog( "close" );
      }
    },
  });

  $( ".create-contact" )
    .live("click", function(e) {
      e.preventDefault();
      $( "#dialog-contact" ).load(cfg.baseUrl + "/admin/organization/add/contact").dialog( "open" );
    });
  $( ".editContact" )
    .live("click", function(e) {
      e.preventDefault();	
	  var contactIndex = ($(this).attr("componentIndex"));
	  var agentKey = ($(this).attr("agentKey"));
      $( "#dialog-contact" ).load(cfg.baseUrl + "/admin/organization/" + agentKey + "/edit/contact/"+contactIndex).dialog( "open" );
    });	
	
  });