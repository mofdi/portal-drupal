
/**
 * This library provides the functionality for the filters used to construct criteria for 
 * (e.g.) downloads.  This is built on JQuery-UI with a dependency only of the core and
 * widgets within the JQuery UI project.
 *
 * This contains 2 Widgets:
 *  - Filter providing the means to select the subject, predicate and the value of the 
 *    criteria.  This is driven by a JSON configuration file.
 *
 *  - Query providing a summary view of the query as constructed by filter parts.
 * 
 * Author: Tim Robertson
 */
(function($) {
  /**
   * The filters are driven entirely by JSON configuration.
   * When a filter is added, the addFilter event is broadcast, allowing other widgets
   * to be wired up to this.
   */
  $.widget("gbif.Filter", {
    options: {
      addFilter: $.noop,  // avoid nulls, allow overriding during construction
    },

    // call the JSON over AJAX
    _create: function() {
      var self = this.element;
      this._loadData(this.options.json);      
      this.filterContainer = $("<DIV class='container' style='float:left'/>").appendTo(self);
      this._renderSubjectSelector();
      this._renderAddFilter();
      this.descriptionContainer = $("<DIV class='description'/>").appendTo(self);
      this.errorContainer = $("<DIV class='description error' style='display:none'/>").appendTo(self);
      this.subjectSelect.change();
      this._deserialize(); // set up any existing filters from the URL
    },

    // utilities for setting the subject, predicate and value
    _setSubject: function(val) {
      this.filter.subject = val;
    },
    _setPredicate: function(val) {
      this.filter.predicate = val;
    },
    _setValue: function(val) {
      this.filter.value = val;
    },
    _setMaxValue: function(val) {
      this.filter.maxValue = val;
    },
    _setSubjectId: function(val) {
      this.filter.subjectId = val;
    },
    _setPredicateId: function(val) {
      this.filter.predicateId = val;
    },

    // Loads and stores the data from ajax using a synchronous call (hence not the $json method)
    _loadData: function(url) {
      var that = this;
      console.log("Loading JSON from " + url);
      $.ajax({
        type: 'GET', url: url, async: false, dataType: 'json',
        success: function(data) { 
          console.log("Loaded JSON from " + url);
          that.data = data; 
        }, 
      });  
    },

    // Renders the subject selector and broadcasts the changed event
    _renderSubjectSelector: function() {
      console.log("Setting up the subject selector");
      var that = this;
      console.log("Reading JSON to populate subject selector");      
      var el = $('<SELECT/>').addClass("subject");
      that.subjectSelect = el;  // to be accessible from other methods
      $.each(that.data.filters, function () {
        var el2 = $("<optgroup label=" + this.group + "/>").appendTo(el);
        $.each(this.options, function () {
          el2.append($('<OPTION></OPTION>').attr('value',this.name).text(this.name));    
        });  
      });
      el.appendTo(this.filterContainer);
      // broadcast changes on the "changed" event
      el.bind('change', function(event) {
        $.each(that.data.filters, function (i, filter) {    
          $.each(this.options, function (i2, filter) {
            if ($(el,"option:selected").val() == filter.name) {
              console.log("Detected subject change to " + el.val());
              that._setSubject(el.val());
              that._setSubjectId(filter.id);
              that._setPredicate(null);
              that._setPredicateId(null);
              that._setValue(null);
              that._setMaxValue(null);
              that._renderFilter(filter);
              that.descriptionContainer.html(filter.description);
              that.descriptionContainer.show();
              that.errorContainer.hide();
              $("#addFilterBtn").attr('disabled',false);
            }
          });
        });    
      });

    },

    // utility to allow this to be called from various places
    _fireAddFilter: function() {
      console.log("Firing the addFilter event");
      this._trigger('addFilter', null, {filter : this.filter});
    },

    // Renders the add filter button, registers the addFilter event
    _renderAddFilter: function() {
      var that = this;
      var self = this.element;
      that.filter = $("<SPAN class='filter'/>");
      that.filter.appendTo(this.filterContainer);

      that.addFilter = $("<INPUT type='submit' id='addFilterBtn' value='Add filter'></INPUT>");
      // Register the add filter event for public subscription
      that.addFilter.bind('click', function(event) {        
        that._fireAddFilter();
        that._setValue(null);
        that._setMaxValue(null);
        $("#filter-container :text").each( function(idx,element){
          $(element).val('');
        });
      });
      that.addFilter.appendTo(self);
      self.append("<br>")
    },

    // Renders the filter calling the renderer by name using bracket notation i.e. ['name']()
    _renderFilter: function(filter) {
      console.log("Rendering filter: " + filter.renderer);
      this.filterContainer[filter.renderer]({parent:this, data:filter.data});
    },

    // reads the params from the URL, and sets up the filters on the display
    _deserialize: function() {
      var that = this;
      var loop = true;
      var i=0;
      while(loop) {
        var subjectId = $.url().param('f[' + i + '].s');
        var predicateId = $.url().param('f[' + i + '].p');
        var value = $.url().param('f[' + i + '].v');

        if (subjectId != null && predicateId != null && value != null) {
          // we have a filter from the URL
          console.log(subjectId + ": " + predicateId + ": " + value);

          // find the appropriate filter to get the displayable info
          // this iterates groups (Taxonomy, Geospatial etc)
          $.each(that.data.filters, function (i, filter) {    
            // this iterates options in the group (Scientific name, common name etc)
            $.each(this.options, function (i2, filter) {
              if (subjectId == filter.id) {
                that._setSubject(filter.name);
                that._setSubjectId(filter.id);

                // find the chosen predicate
                $.each(filter.data.predicate, function (i3, predicate) {
                  if (predicate.value == predicateId) {
                    that._setPredicate(predicate.label);
                  }
                });

                that._setPredicateId(predicateId);
                if(value.indexOf(',') == -1){
                  that._setValue(value);
                  that._setMaxValue(null);
                }else{
                  var splitValue = value.split(',');
                  that._setValue(splitValue[0]);
                  that._setMaxValue(splitValue[1]);
                }
                console.log(subjectId + ": " + predicateId + ": " + value);
                that._fireAddFilter();
              }
            });
          });

        } else {
          loop = false;
        }

        i++;
      }

      // we need to reset the filter to the original values
      // changing the subject selector fires all the initialization
      that.subjectSelect.trigger('change');
    }

  });
  
  $.widget("gbif.BaseWidget", {
    _getOrCreateExpressionContainer : function(container){
      var divExpression = container.children(".expression")[0];
      if(divExpression){
        $(divExpression).remove();
      }
      divExpression = $('<SPAN class="expression"/>');
      return divExpression;
    }
  });

  // Renders a select with a text box input
  $.widget("gbif.SelectAndTextbox", $.gbif.BaseWidget , {       
    _isValidDecimalPrecision: function(value,decimalPrecision) {
      if(decimalPrecision != 'undefined' && decimalPrecision != null){
        var splitByDot = value.split('.');
        if(splitByDot.length > 1){
          var decimalPart = splitByDot[1];
          return(decimalPart.length + 1 <= decimalPrecision);
        }
      }
      return true;
    },
    _isValidIntegerPrecision: function(value,precision) {
      if (precision != 'undefined' && precision != null) {
        var splitByDot = value.split('.');      
        var intPart = splitByDot[0];
        var newLength = intPart.length;
        var hasDot = value.indexOf('.') > -1;
        if (!hasDot) {
          newLength +=1;
        }        
        return(newLength <= precision);
      }
      return true;
    },
    _displayInvalidNumberMsg : function(errorOption){
      var parent = this.options.parent; // the owning widget
      var errMsg = 'The input contains an invalid value.<br>';
      var data = this.options.data;
      var size = data.size;
      var minValue = data.minValue;
      var maxValue = data.maxValue;
      var intPrecision = data.integerPrecision;
      var decimalPrecision = data.decimalPrecision;
      var hasError = errorOption.minValue || errorOption.maxValue  || errorOption.intPrecision || errorOption.decimalPrecision || errorOption.decimalPoint;
      if(errorOption.minValue && minValue != 'undefined' && minValue != null){
        errMsg = errMsg + 'Minimum value should be greater than ' + minValue + '.<br>';
      }
      if(errorOption.maxValue && maxValue != 'undefined' && maxValue != null){
        errMsg = errMsg + 'Maximum value should be less than ' + maxValue + '.<br>';
      }
      if(errorOption.intPrecision && intPrecision != 'undefined' && intPrecision != null){
        errMsg = errMsg + 'The integer value can not contain more than ' + intPrecision + ' digits of precision.<br>';
      }
      if(errorOption.decimalPrecision && decimalPrecision != 'undefined' && decimalPrecision != null){
        errMsg = errMsg + 'The decimal value can not contain more than ' + decimalPrecision + ' digits of precision.<br>';
      }
      if(errorOption.decimalPoint){
        errMsg = errMsg + 'Only 1 decimal point is allowed.<br>';
      }
      if(hasError){
        parent.errorContainer.html(errMsg);
        parent.errorContainer.show();
        parent.descriptionContainer.hide();
      } else {
        parent.errorContainer.hide();
        parent.descriptionContainer.show();
      }
    },
    _numbersOnly : function(event,isDecimal,decimalPrecision,intPrecision) {   
        $("#addFilterBtn").attr('disabled',false);
        var code = (event.keyCode ? event.keyCode : event.which);
        var parent = this.options.parent; // the owning widget
        parent.errorContainer.hide();
        parent.descriptionContainer.show();
        if(isDecimal) {
          var hasDot = event.target.value.indexOf('.') > -1;
          if(code == 190) { // only 1 . is allowed          
            if(!hasDot) {
              if(event.target.value.length > 0){
                return;
              }
            }else{
              this._displayInvalidNumberMsg({minValue: false,maxValue:false,intPrecision:false,decimalPrecision:false,decimalPoint:true});
            }
          } 
        }        
        if (code == 46 || code == 8 || code == 9 || code == 27 || code == 13 || (code == 65 && event.ctrlKey === true) || (code >= 35 && code <= 39)) {
            return;
        }
        else {   
            if (event.shiftKey || (code < 48 || code > 57) && (code < 96 || code > 105)) {              
              event.preventDefault();
            }
        }        
        var isValidPrecision = this._isValidIntegerPrecision(event.target.value,intPrecision);
        var isValidDecimalPrecision = this._isValidDecimalPrecision(event.target.value,decimalPrecision);
        if(isValidPrecision && isValidDecimalPrecision) {           
          return;
        } else { 
          this._displayInvalidNumberMsg({minValue: false,maxValue:false,intPrecision:!isValidPrecision,decimalPrecision:!isValidDecimalPrecision,decimalPoint:false});
          event.preventDefault();
        }                                       
    },
    _isValidNumber : function(value,isDecimal,minValue,maxValue){
      if(value.length > 0){
        var numValue;
        if(isDecimal){
          numValue = parseFloat(value);
        }else{
          numValue = parseInt(value);
        }    
        var validMinValue = (minValue == null || (numValue >= minValue));
        var validMaxValue = (maxValue == null || (numValue <= maxValue));
        if(validMinValue || validMaxValue){
          this._displayInvalidNumberMsg({minValue: !validMinValue,maxValue:!validMaxValue,intPrecision:false,decimalPrecision:false,decimalPoint:false});
        }
        return (validMinValue && validMaxValue);
      }
      return true;
    },
    _createInput : function(data,isMaxValue){
      var that = this;
      var size = 30; //DEFAULT SIZE
      var maxLength = 30; //DEFAULT MAX LENGTH
      var parent = this.options.parent; // the owning widget
      var input = null;
      if(data.size){
        size = data.size;
      }      
      if(data.maxLength){
        maxLength = data.maxLength;
      }
      
      input = $('<INPUT SIZE="'+size+'" MAXLENGTH="'+maxLength+'"/>');
      
      var maxValue = null;
      var minValue = null;
      var decimalPrecision = 2; //DEFAULT of 2      
      var intPrecision = null;      
      var isANumber = data.dataType != 'undefined' && (data.dataType == 'numeric' || data.dataType == 'decimal'); 
      var isDecimal = false; 
      if(isANumber){
        isDecimal = (data.dataType === 'decimal');
        if(data.maxValue !== null){
          maxValue = data.maxValue;
        }
        if(data.minValue !== null){
          minValue = data.minValue;
        }
        if(data.decimalPrecision !== null){
          decimalPrecision = data.decimalPrecision;
        }
        if(data.integerPrecision !== null){
          intPrecision = data.integerPrecision;
        }
        input.keydown(function(event) { that._numbersOnly(event,isDecimal,decimalPrecision,intPrecision) });
        input.change(function(event) { $("#addFilterBtn").attr('disabled',!that._isValidNumber(event.target.value,isDecimal,minValue,maxValue));});
      }
      
      input.bind('change', function(e) {
        console.log("Filter value changed to " + e.target.value);
        that._setValue(e.target.value,isMaxValue,parent);
      });    

      // trigger an add filter on carriage return
      input.bind('keypress', function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13) {
          if(isANumber){
            var isValidNumber = that._isValidNumber(e.target.value,isDecimal,minValue,maxValue);
            $("#addFilterBtn").attr('disabled',!isValidNumber);
            if(isValidNumber){
              that._setValue(e.target.value,isMaxValue,parent);
              parent._fireAddFilter();
            }
          }else{
            that._setValue(e.target.value,isMaxValue,parent);
          }
        }
      });            
      return input;
    },
    _setValue : function(value,isMaxValue,widget){
      if(isMaxValue){
        widget._setMaxValue(value);
      }
      else {
        widget._setValue(value);
      }
    },
    _init : function() {
      var that = this;      
      var self = this.element;
      var parent = this.options.parent; // the owning widget
      var data = this.options.data;
      var divExpression = this._getOrCreateExpressionContainer(parent.filterContainer);

      console.log("Rendering SimpleSelect");      
      var el = $('<SELECT/>').addClass("predicate");
      this.predicate = el;
      $.each(data.predicate, function () {
        var opt = $('<OPTION></OPTION>');
        opt.attr('value',this.value).text(this.label);
        if(this.isRange != 'undefined' && this.isRange){
          opt.addClass("range");          
        }
        el.append(opt);
      });
      el.bind('change', function(event) {
        var selectedOpt = $(el).find("option[value='" + el.val() + "']");
        parent._setPredicate(selectedOpt.text());
        parent._setPredicateId(el.val());
        if($(selectedOpt).hasClass('range')){
          that.valueMax.parent().show();
        } else if(that.valueMax) {
            that.valueMax.val('');
            that.valueMax.parent().hide();
        }
      });    
      el.change();

      this.value = that._createInput(data,false);            
      divExpression.append(el).append(this.value);
      
      if(data.isRange != 'undefined' && data.isRange){
        var divValueMax = $('<DIV style="float:right"> and </DIV>');
        this.valueMax = that._createInput(data,true);
        divValueMax.append(this.valueMax);
        divValueMax.hide();
        divExpression.append(divValueMax);
      }
      parent.filterContainer.append(divExpression);
    },
  });

  // Renders 2 select options
  $.widget("gbif.SelectSelect",$.gbif.BaseWidget, {  
    _init : function() {
      var that = this;
      var self = this.element;
      var parent = this.options.parent; // the owning widget
      var data = this.options.data;
      var divExpression = this._getOrCreateExpressionContainer(parent.filterContainer);
      
      
      console.log("Rendering SelectSelect");
      var el = $('<SELECT />').addClass("predicate");
      this.predicate = el;
      
      $.each(data.predicate, function () {
        el.append($('<OPTION></OPTION>').attr('value',this.value).text(this.label));    
      });
      el.bind('change', function(event) {
        parent._setPredicate($(el).find("option[value='" + el.val() + "']").text());
        parent._setPredicateId(el.val());
      });    
      el.change();


      // TODO: CSS-ify the width
      var width = 50; //DEFAULT SIZE     
      if(data.width != 'undefined' && data.width != null){
        width = data.width;
      }
      var el2 = $('<SELECT style="width:' + width + 'px"/>').addClass("value");
      this.value = el2;
      $.each(data.value, function () {
        el2.append($('<OPTION></OPTION>').attr('value',this).text("" + this));    
      });
      el2.bind('change', function(event) {
        parent._setValue(el2.val());
      });   
      // trigger an add filter on carriage return
      this.value.bind('keypress', function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13) {
          parent._setValue(e.target.value);
          parent._fireAddFilter();
        }
      });

      el2.change();
      divExpression.append(el).append(this.value);
      self.append(divExpression);	 
    }, 
  });

  // Renders the Geometry filter which allows users to draw polygons
  $.widget("gbif.Geometry", {  
    _init : function() {
      var that = this;
      var self = this.element;
      var parent = this.options.parent; // the owning widget
      var data = this.options.data;

      var el = $('<SELECT/>').addClass("predicate");
      this.predicate = el;
      $.each(data.predicate, function () {
        el.append($('<OPTION></OPTION>').attr('value',this.value).text(this.label));    
      });
      el.bind('change', function(event) {
        parent._setPredicate($(el).find("option[value='" + el.val() + "']").text());
        parent._setPredicateId(el.val());
      });    
      el.change();

      self.empty().append(el).append("... TODO ...");	

      var el2 = $("<DIV class='geometery-container'/>");
      var mapEl = $("<div id='map_canvas'></div>");
      el2.append(mapEl);
      el2.append("<div class='general_options'><ul><li class='map'><a class='add_polygon'>Draw</a></li></ul></div>");

      var styles = [ 
                    {
                      featureType: 'all',
                      stylers: [
                                { saturation: -80 }
                                ]
                    },    
                    ];
      var mapOptions = {
          zoom: 2,
          center: new google.maps.LatLng(20, 0),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles: styles,
      };
      //self.parent().parent().append(el2);	



      // test a dialog
      var modal = $("<DIV/>");
      modal.append(mapEl);
      modal.append("<div class='map_options'><ul class='add_primary'><li><a class='add_polygon'>Draw</a></li><li class='confirm'><a class='confirm simplemodal-close'>Confirm</a></li><li class='discard'><a class='discard simplemodal-close'>Discard</a></li></ul></div>");
      // This would be a JQuery-UI modal, but the CSS is a nightmare, so using simple modal
      //modal.dialog({modal: true, resizable: false, width: ($(window).width() * 0.8), height: ($(window).height() * 0.8)});
      modal.modal();
      mapEl.css('width', modal.parent().width());
      mapEl.css('height', (modal.parent().height()-30));

      //var map = new google.maps.Map(mapEl[0], mapOptions);    

      var map = new google.maps.Map(mapEl[0], {
        zoom: 2,
        center: new google.maps.LatLng(20, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: styles,
        disableDefaultUI: true,
        zoomControl: true
      });

      var polyOptions = {
          strokeWeight: 0,
          fillOpacity: 0.45,
          editable: true,
          fillColor: "#FF8C00"
      };
      // Creates a drawing manager attached to the map that allows the user to draw
      // markers, lines, and shapes.
      console.log("Adding drawing manager");
      var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        markerOptions: {
          draggable: true
        },
        polylineOptions: {
          editable: true
        },
        rectangleOptions: polyOptions,
        circleOptions: polyOptions,
        polygonOptions: polyOptions,
        map: map
      });

      $(".add_polygon").bind('click', function(e) {
        //map.setOptions({draggableCursor:'crosshair'});
        //var geometry_creator_ = new GeometryCreator(map);
      });


    }, 
  }); 

  /**
   * Handles the current search criteria and makes it displayable 
   * for the user
   */
  $.widget("gbif.Query", {
    options: {
      removeFilter: $.noop,  // avoid nulls, allow overriding during construction
    },
    _create : function() {
      // hold an array of filters
      this._filters = [];
    },
    //removes a filter
    remove : function(i){      
      this._filters.splice(i,1);
      this._refresh();
      this._trigger('removeFilter', null, {widget : this,idx: i});
    },
    add: function(filter) {
      // copy the values and put in the array
      this._filters.push({
        subject: filter.subject,
        subjectId: filter.subjectId,
        predicate: filter.predicate,
        predicateId: filter.predicateId,
        value: filter.value,
        maxValue: filter.maxValue});

      this._refresh();
    }, 

    _refresh: function() {
      var self = this.element.empty();
      var widget = this;

      $.each(this._filters, function(i, filter) {
        // have we seen this subject before?
        // spaces are not allowed in HTML id
        var id = "query-view-" + replaceAll(filter.subject, ' ', '_') + replaceAll(filter.predicate, ' ', '_');
        var ul = $('#' + id);
        if (ul.html() == null) {
          ul = $("<UL class='query' id='" + id +"'/>");
          if (self.children().size()>0) {
            self.append("<P class='query'>AND " + filter.subject.toUpperCase() + " " + filter.predicate.toUpperCase() + "</P>");
          } else {
            self.append("<P class='query'>" + filter.subject.toUpperCase() + " " + filter.predicate.toUpperCase() + "</P>");
          }
          self.append(ul);
        }
        var prefix = "";
        if (ul.children().size()>0) {
          var prefix = "<SPAN class='boolean'>OR</SPAN> ";
        }
        link = $("<A href='#' id='" + "fRemLnk" + i +"'>remove</A></LI>");
        //binds the click function to widget.remove function
        link.click(function() {widget.remove(i);});
        var value = null;
        if(filter.maxValue != 'undefined' && filter.maxValue != null){
          value =  filter.value + " AND " + filter.maxValue;
        }else {
          value =  filter.value;
        }
        $("<LI>" + prefix + value + " </LI>").appendTo(ul).append(link);
      });
    },

    serialize: function() {
      var s = "";
      $.each(this._filters, function(i, filter) {
        if (i>0) s += "&"; 
        else s += "?";
        s += "f[" + i + "].s=" + filter.subjectId;
        s += "&f[" + i + "].p=" + filter.predicateId;
        var value = null;
        if(filter.maxValue != 'undefined' && filter.maxValue != null){
          value =  filter.value + "," + filter.maxValue;
        }else {
          value =  filter.value;
        }
        s += "&f[" + i + "].v=" + value;
      });
      return s;
    },    
  }); 

  // Utility function
  function replaceAll(txt, replace, with_this) {
    return txt.replace(new RegExp(replace, 'g'),with_this);
  }  
})(jQuery);