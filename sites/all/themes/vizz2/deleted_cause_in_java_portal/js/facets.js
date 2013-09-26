/*
 * Copyright 2011 Global Biodiversity Information Facility (GBIF)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */  	
  $(function() {	  		  
	  $('.seeAllFacet').each( function(){
		 $("a.seeAllLink", this).bindDialogPopover($("div.dialogPopover", this));
	  });

	$('#resetFacetsButton').click( function(event){
		$('.facet input:checkbox').each( function(){this.checked = false});
		$('#formSearch input:hidden').remove();
    $('#resetFacets input.defaultFacet').appendTo($('#formSearch'));
		$('#formSearch').submit();
		showWaitDialog();
	});
	
    // activates higher taxon links
    $('.higherTaxonLink').click( function(event){
      event.preventDefault();
      addFacet('highertaxon_key', $(this).attr('key'));
	  });

    // toggle facet box
    // requires global cfg variable to exist
    $('.facet ul li:not([class])').each( function(){
    	var thisLi = this;
    	$('a',thisLi).click( function(event){
    		event.preventDefault();
    		//when a facet is selected, all facet checkboxes are disable to avoid multiple requests
    		$('input',thisLi).attr('checked',!$('input',thisLi).checked);
    		$('input',thisLi).click();
    	});
    	$('input',thisLi).click( function(event){    		
    		var location = cfg.currentUrl;
        console.log(location);
        console.log(cfg);
    		$('.facet input:checkbox').each(function(){
          $(this).attr('disabled','true');
        });
    		showWaitDialog();
    		$('input:hidden[value='+ this.value +']').remove();
    		if(this.checked){
    		  if(location.indexOf('?') == -1){ //Condition that checks if the facet is the first parameter
    		    //If it is the first parameter the '&' is removed
    		    location =  location + '?' + this.value.substring(1,this.value.length);
    		  }else {
    		    location =  location + this.value;    		    
    		  }
    		}else{
    		  //2 replaces are done to remove patterns: '&PARAM=value' and 'PARAM=value'
    		  //second case applies when the parameter is the first in the list
    			location = location.replace(this.value,'');
    			location = location.replace(this.value.substring(1,this.value.length),'');
    			if (location.indexOf('?&') != -1){
    			  var firstAmpPosition = location.indexOf('&');
    			  location = location.substring(0,firstAmpPosition) + location.substring(firstAmpPosition + 1,location.length);
    			}
    		}
    		window.location= location;
    	})
  	 });


	  $('.facetFilter').each( function(){
      var span = $("span.flabel", this);
      var facetFilter = span.text().toLowerCase();
      var facetValue  = span.attr("val");
      $("a", this).click(function(event) {
        event.preventDefault();
        console.log(facetFilter, facetValue);
        removeFacet(facetFilter, facetValue);
      });
	  });
	  
    function addFacet(facetName,facetFilter) {
      var queryParams = currentFilterParams();
      queryParams.push(facetName + "=" + facetFilter);
      changeLocation(queryParams);
    }
    function replaceFacet(facetName,facetFilter) {
      var queryParams = currentFilterParams();
      $.each(queryParams, function(i, val) {
        if (val.substring(0, facetName.length+1) == facetName+"=") {
          queryParams.splice (i,1);
        }
      });
      queryParams.push(facetName + "=" + facetFilter);
      changeLocation(queryParams);
    }
    function showWaitDialog(){
    	$('#waitDialog').css("top", getTopPosition($('#waitDialog')) + "px");
		$('#waitDialog').fadeIn("medium", function() { hidden = false; });
		$("body").append("<div id='lock_screen'></div>");
	    $("#lock_screen").height($(document).height());
	    $("#lock_screen").fadeIn("slow");
    }
    function getTopPosition(div) {
        return (( $(window).height() - div.height()) / 2) + $(window).scrollTop() - 50;
      }
    
    function removeFacet(facetName,facetFilter) {
      var queryParams = currentFilterParams();
      var removeParam = facetName + "=" + facetFilter;
      var idx = $.inArray(removeParam, queryParams);
      if (idx >= 0){
        queryParams.splice (idx,1);
      }
      changeLocation(queryParams);
    }
    
    function changeLocation(queryParams) {
      window.location.replace(window.location.pathname + '?' + queryParams.join('&'));
    }
	  function currentFilterParams() {
      var facetFilterParams = new Array();
      $('.facetFilter').each(function(){
        var span = $("span.flabel", this);
        facetFilterParams.push(span.text().toLowerCase() + "=" + span.attr("val"));
      });

      $.merge(facetFilterParams,currentQueryParam());
      return facetFilterParams.unique();
	   };
	

	  function currentQueryParam() {
		// get the pairs of params fist
		var pairs = unescape(location.search.substring(1)).split('&');
		var values = [];		
		// now iterate each pair
		for (var i = 0; i < pairs.length; i++) {
		  var params = pairs[i].split('=');
		  if (params[0] != "limit" && params[0] != "offset") {
		    values.push(pairs[i]);		    
		  }
		}
		return values;
	  };
  })
