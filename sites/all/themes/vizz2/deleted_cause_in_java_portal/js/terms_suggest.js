/**
    * Simple Autosuggest widget.
    * Creates an Autosuggest widget using a web service, the web service response should be a list of strings.   
    * @param wsServiceUrl url to the search/suggest service
    * @param appendToElement parent element of generated widget
    */
$.extend($.ui.autocomplete.prototype, 
         {highlight: function(value, term) {
              return value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + term.replace(/([\^\$\(\)\[\]\{\}\*\.\+\?\|\\])/gi, "\\$1") + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<strong>$1</strong>");
          }
    }); 
$.fn.termsAutosuggest = function(wsServiceUrl,appendToElement,limit) {
      //reference to the widget
      var $this = $(this);
      //jquery ui autocomplete widget creation
      $this.autocomplete({source: function( request, response ) {
       $.ajax({
           url: wsServiceUrl,
           dataType: 'jsonp', //jsonp is the default
           data: {
             q: $this.val(),
             limit: limit
           },
           success: function (data) { //response the data sent by the web service              
             response(data);              
           }
         });
       },
       create: function(event, ui) {
        //forcibly css classes are removed because of conflicts between existing styles and jquery ui styles
        $(".ui-autocomplete").removeClass("ui-widget-content ui-corner-all");
        $(".ui-autocomplete").css("z-index",1000);
       },
       open: function(event, ui) {
         //a high z-index ensures that the autocomplete will be "always" visible on top of other elements
          $(".ui-autocomplete").css("z-index",1000);
          //sets child classes of li elements according to the returned elements
        if ($(".ui-autocomplete li").length == 1){
         $(".ui-autocomplete li:first-child").addClass("unique");
        }
        else{
         $(".ui-autocomplete li:first-child").addClass("first");
         $(".ui-autocomplete li:last-child").addClass("last");
        }
       },
       appendTo: appendToElement,
       focus: function( event, ui ) {//on focus: sets the value of the input[text] element             
            $this.val( ui.item.value);              
             return false;
           },
       select: function( event, ui ) {//on select: sets the value of the input[text] element              
             $this.val( ui.item.value);
             return false;
           }
     }).data( "autocomplete" )._renderItem = function( ul, item) {       
     return $( "<li></li>" )
     .data( "item.autocomplete", item )
     .append("<a class='name'>" + this.highlight(item.value,$this.val()) + "</a>")
     .appendTo( ul );
     //last line customizes the generated elements of the auto-complete widget by highlighting the results and adding new css class
     };   
    }