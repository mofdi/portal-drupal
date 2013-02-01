var map,nubId, datasetId;

    // Necessary things to run these kind of map
    // - class typesmap to body
    // - occurrence/diversity/distribution/points 'a' tags have to be -> <a href="#" title="occurrence">grid</a> -> respect the title, you can change the text
    // - zooms html (example in /content/dataset/detail.html)


	$(function(){
		// If body has typesmap class - search #map and start rendering map
		if ($('body').hasClass('typesmap')) {
	
      nubId = $("#map").attr("nubid");
      datasetId = $("#map").attr("datasetid");
			// Create zoom controls
			$('a.zoom_in').click(function(ev){
				ev.stopPropagation();
				ev.preventDefault();
				map.zoomIn();					
			});
			$('a.zoom_out').click(function(ev){
				ev.stopPropagation();
				ev.preventDefault();
				map.zoomOut();
			});
			
			//Projection buttons
			$('div.projection a.projection').click(function(ev){
				ev.stopPropagation();
				ev.preventDefault();
				$(this).parent().find('span').show();
				$('body').click(function(ev){
					if (!$(event.target).closest('div.projection').length) {
	          $('div.projection span').hide();
	          $('body').unbind('click');
	        };
				});
			});
			
			$('div.projection span ul li a').click(function(ev){
				ev.stopPropagation();
				ev.preventDefault();
				if (!$(this).parent().hasClass('disabled') && !$(this).hasClass('selected')) {
					$('div.projection span ul li a').each(function(i,ele){$(ele).removeClass('selected')});
					$(this).addClass('selected');
					// TODO -> implement robinson projection
					$(this).closest('span').hide()
					$('body').unbind('click');					
				}
			});

			// Change map type
			$('p.maptype a').click(function(ev){
				ev.stopPropagation();
				ev.preventDefault();
				var type_ = $(this).attr('title');
				$('p.maptype a').each(function(i,ele){
					$(ele).removeClass('selected');
				});
				$(this).addClass('selected');
				chooseLayer(type_);
			});
			
			
			// Initialize map
      // WGS84
      var wgs84 = new OpenLayers.Projection("EPSG:4326");
      // map uses the SphericalMercator projection
      map = new OpenLayers.Map("map", {
          maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
          numZoomLevels:18,
          maxResolution:156543.0339,
          units:'m',
          projection: "EPSG:900913",
          displayProjection: wgs84,
          controls: []
      });

      // Layers
      var gphy = new OpenLayers.Layer.Google(
          "Google Physical",
          {type: google.maps.MapTypeId.TERRAIN}
      );
      map.addLayer(gphy);

      var gsat = new OpenLayers.Layer.Google(
          "Google Satellite",
          {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22}
      );

      if (nubId > 0){
        var gbifocc = new OpenLayers.Layer.TMS(
            "GBIF Occurrences",
            "http://staging.gbif.org:8080/tile-server/density/tile?type=TAXON&key=" + nubId, {
              layername: "occurrences",
              type: "png",
              isBaseLayer: false,
              getURL: function(bounds) {
                  var res = this.map.getResolution();
                  var x = Math.round ((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
                  var y = Math.round ((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
                  var z = this.map.getZoom();
                  var path = "&z=" + z +"&x=" +x+"&y=" + y;
                  var url = this.url;
                  //if (url instanceof Array) {
                    //url = this.selectUrl(path, url);
                  //}
                  return url + path;
              },

              getId: function(viewPortPx) {
                  var bounds = this.getTileBounds(viewPortPx);
                  var res = this.map.getResolution();
                  var x = Math.round ((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
                  var y = Math.round ((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
                  var z = this.map.getZoom();
                  return x + "_" + y + "_" + z;
              }
            }
        );
        map.addLayer(gbifocc);

    		// TODO: create diversity_layer & distribution_layer

      }

      if (datasetId){
    		// TODO: create real tiles layer for entire occurrence dataset!
        var datasetLayer = new OpenLayers.Layer.TMS(
            "GBIF Occurrences",
            "http://140.247.231.188/php/map/getEolTile.php", {
              layername: "occurrences",
              type: "png",
              isBaseLayer: false,
              getURL: function(bounds) {
                  var res = this.map.getResolution();
                  var x = Math.round ((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
                  var y = Math.round ((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
                  var z = this.map.getZoom();

                  var path = "?tile=" + x + "_" + y + "_" + z + "_"+nubId;
                  var url = this.url;
                  if (url instanceof Array) {
                    url = this.selectUrl(path, url);
                  }
                  return url + path;
              },

              getId: function(viewPortPx) {
                  var bounds = this.getTileBounds(viewPortPx);
                  var res = this.map.getResolution();
                  var x = Math.round ((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
                  var y = Math.round ((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
                  var z = this.map.getZoom();
                  return x + "_" + y + "_" + z;
              }
            }
        );
        //TODO: add layer to map once it is for real
        //map.addLayer(datasetLayer);
      }

      if (typeof(map_features) != "undefined"){
        // http://dev.openlayers.org/apidocs/files/OpenLayers/Layer/Vector-js.html
        // http://www.peterrobins.co.uk/it/olvectors.html

        var pl = new OpenLayers.Layer.Vector(
          "Boundaries", {
            projection: wgs84,
            style: {
                strokeColor: "orange",
                strokeWidth: 1.5,
                fillColor: "grey",
                fillOpacity: 0.4,
                cursor: "pointer"
            }
        });

        // parse well known text features
        var parser = new OpenLayers.Format.WKT();
        $.each(map_features, function(idx, val){
            var feat = parser.read(val);
            // transform into spherical mercator from wgs84
            feat.geometry.transform(wgs84, map.getProjectionObject());
            pl.addFeatures(feat);
          }
        );
        map.addLayer(pl);
      }

      //map.addControl(new OpenLayers.Control.LayerSwitcher());

      // Google.v3 uses EPSG:900913 as projection, so we have to
      // transform our coordinates
      map.setCenter(new OpenLayers.LonLat(0, 0).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject()), 1);

      // Select the correct map type with .selected class
      var type_ = $('p.maptype').find('a.selected').attr('title');
      chooseLayer(type_);

      // Activate double click
			var dblclick = new OpenLayers.Handler.Click(this, {dblclick: function() {map.zoomIn()}, click: null }, {single: true, 'double': true, stopSingle: false, stopDouble: true});
	    dblclick.setMap(map);
	    dblclick.activate();

			// Drag with mouse
			map.addControl(new OpenLayers.Control.Navigation({zoomWheelEnabled : false}));
			map.addControl(new OpenLayers.Control.MousePosition({element: $('#map')}));

		}
	});

	function chooseLayer(layer) {
    // we only have one layer for now, dont do anything
	}


