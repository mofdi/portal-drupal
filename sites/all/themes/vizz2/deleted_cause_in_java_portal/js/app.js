$(function() {

  if (!Modernizr.input.placeholder){ // placeholder fix

    $("input").each(
      function(){
        if($(this).val()=="" && $(this).attr("placeholder")!=""){
          $(this).val($(this).attr("placeholder"));
          $(this).focus(function(){
            if($(this).val()==$(this).attr("placeholder")) $(this).val("");
          });
          $(this).blur(function(){
            if($(this).val()=="") $(this).val($(this).attr("placeholder"));
          });
        }
      });
  }


  // DROPDOWN

  $(".dropdown .title").on("click", function(e) {
    e.preventDefault();
    $(this).parent().toggleClass("selected");
  });

  // PHOTO GALLERY
  $(".photo_gallery").bindSlideshow();

  // GRAPHS
  $("div.graph li a, div.bargraph li a").on("click", function(e) {
    e.preventDefault();
  });

  $("body.home nav").on("mouseleave", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $("li.search form").animate({ width: 10, opacity: 0}, 250, function() {
      $("a[data-action='show-search']").fadeIn(150);
    });

  });

  $("body.home a[data-action='show-search']").on("mouseover", function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).fadeOut(150, function() {
      $(this).parent().find("form").animate({ width: 180, opacity: 1}, 250, function() {
        $(this).find("input").focus();
      });
    });

  });

  $('div.graph').each(function(index) {
    $(this).find('ul li .value').each(function(index) {
      var width = $(this).parents("div").attr("class").replace(/graph /, "");
      $(this).parent().css("width", width);
      var value = $(this).text();
      $(this).delay(index * 100).animate({ height: value }, 400, 'easeOutBounce');
      var label_y = $(this).parent().height() - value - 36;
      $(this).parent().find(".label").css("top", label_y);
      $(this).parent().append("<div class='value_label'>" + value + "</div")
      $(this).parent().find(".value_label").css("top", (label_y + 13));
    });
  });

  $('div.bargraph').each(function(index) {
    $(this).find('ul li .value').each(function(index) {
      var width = $(this).parents("div").attr("class").replace(/bargraph /, "");
      $(this).parent().css("width", width);
      var value = $(this).text();
      $(this).delay(index * 100).animate({ height: value }, 400, 'easeOutBounce');
      var label_y = $(this).parent().height() - value - 36;
      $(this).parent().find(".label").css("top", label_y);
      $(this).parent().append("<div class='value_label'>" + value + "</div")
      $(this).parent().find(".value_label").css("top", (label_y + 13));
    });
  });


  $('div.graph ul li a').click(function(e) {
    e.preventDefault();
  });

  // focus on form input element with class "focus"
  $('input.focus').focus();

  $(".selectbox").selectBox();

  // Activate source popovers
  $("a.sourcePopup").append('<img src="'+((cfg.context+"/img/icons/questionmark.png").replace("//", "/")) +'"/>').each(function(idx, obj){
    $(obj).sourcePopover({"title":$(obj).attr("title"),"message":$(obj).attr("message"),"remarks":$(obj).attr("remarks")});
  });

  // Activate link popovers
  $("a.popover").each(function(idx, obj){
    $(obj).sourcePopover({"title":$(obj).attr("title"),"message":$(obj).parent().find(".message").html(),"remarks":$(obj).parent().find(".remarks").html()});
  });

  $("a.download")
  .bindDownloadPopover({explanation:"Occurrences of \"Puma concolor\", collected between Jan 1sr, 2000 and Jan 1st, 2010, from dataset \"Felines of the world\"."});
  $("a.download_2")
  .bindDownloadPopover({template: "direct_download", explanation:"Occurrences of \"Puma concolor\", collected between Jan 1sr, 2000 and Jan 1st, 2010, from dataset \"Felines of the world\"."});

  // setup taxonomic browser
  $("#taxonomicBrowser").taxonomicExplorer({transitionSpeed:300});

  // Dropdown for the sorting options of the taxonomic explorer
  $('#tax_sort_ocurrences').dropdownPopover({
    options: {
      links: [
        { name: "Sort alphabetically",
          callback: function(e) {
            e.preventDefault();
            $("#taxonomy .sp").animate({opacity:0}, 500, function() {
              sortAlphabetically($("#taxonomy .sp ul:first"));
              $("#taxonomy .sp").animate({opacity:1}, 500);
            });
          },
          replaceWith:'Sort alphabetically<span class="more"></span>'
        },
        { name: "Sort by count",
          callback: function(e) {
            e.preventDefault();
            $("#taxonomy .sp").animate({opacity:0}, 500, function() {
              sortByCount($("#taxonomy .sp ul:first"));
              $("#taxonomy .sp").animate({opacity:1}, 500);
            });
          },
          replaceWith:'Sort by count<span class="more"></span>'
        }
      ]
    }
  });


  // Dropdown for the language selector
  $('#language_selector').dropdownPopover({
    options: {
      links: [
        { name: "English",
          callback: function(e) {
            e.preventDefault();
            /* add callback action here */
          },
          replaceWith: "<span>EN</span>",
          select: "EN"
        },
        { name: "Spanish",
          callback: function(e) {
            e.preventDefault();
            /* add callback action here */
          },
          replaceWith: "<span>ES</span>",
          select: "ES"
        },
        { name: "Deutsch",
          callback: function(e) {
            e.preventDefault();
            /* add callback action here */
          },
          replaceWith: "<span>DE</span>",
          select: "DE"
        }
      ]
    }
  });


  $('span.input_text input').focus(function() {
    $(this).parent().addClass("focus");
  });

  $('span.input_text input').focusout(function() {
    $(this).parent().removeClass("focus");
  });

  var processes = {
    dates:[
      {start:"2011-1-1", end: "2011-2-11", title: "123 - HARVESTING ", message:"<a href='/members/process_detail.html'>235 issues</a>"},
      {start:"2011-3-1", title: "123 - HARVESTING ", message:"<a href='/members/process_detail.html'>235 issues</a>"},
      {start:"2011-4-1", end:"2011-4-25", title: "123 - HARVESTING ", message:"<a href='/members/process_detail.html'>235 issues</a>"},
      {start:"2011-5-1", title: "123 - HARVESTING ", message:"<a href='/members/process_detail.html'>235 issues</a>"},
      {start:"2011-6-1", title: "123 - HARVESTING ", message:"No processes"},
      {start:"2011-7-1", title: "123 - HARVESTING ", message:"No processes"},
      {start:"2011-8-1", title: "123 - HARVESTING ", message:"No processes"}
      ]};

      if ($("#holder").length) {
        dataHistory.initialize(generateRandomValues(365), {height: 180, processes: processes});
        dataHistory.show();
      }

      // wrapper to use for i18n in JQuery. See README file for how to use it.
      $i18nresources = $.getResourceBundle("resources");

})
