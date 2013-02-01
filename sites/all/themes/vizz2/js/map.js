var CONFIG = { // global config var
  minZoom: 0,
  maxZoom: 14,
  center: [0, 0],
  defaultZoom: 1
};

// Necessary things to run these kind of map
// - class map to body
$(function() {

  // optimize this by ignoring any page with no suitable class
  if ($('body').hasClass('densitymap') || $('body').hasClass('pointmap')) {

    var // see http://maps.cloudmade.com/editor for the styles - 69341 is named GBIF Original
    cmAttr = 'Map data &copy; 2011 OpenStreetMap contributors, Imagery &copy; 2011 CloudMade',
    cmUrl  = 'http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/{styleId}/256/{z}/{x}/{y}.png';

    var
    gbifBase  = L.tileLayer(cmUrl, {styleId: 69341, attribution: cmAttr}),
    minimal   = L.tileLayer(cmUrl, {styleId: 997,   attribution: cmAttr}),
    midnight  = L.tileLayer(cmUrl, {styleId: 999,   attribution: cmAttr});

    var baseLayers = {
      "Classic":    gbifBase,
      "Minimal":    minimal,
      "Night View": midnight
    };

    // Density Maps use the tile-server to overlay tiles
    if ($('body').hasClass('densitymap')) {

      console.log("Rendering map key[" + key + "], type[" + type + "]");

      var
      key        = $("#map").attr("key"),
      type       = $("#map").attr("type"),
      gbifUrl    = cfg.tileServerBaseUrl + '/density/tile?key=' + key + '&x={x}&y={y}&z={z}&type=' + type,
      gbifAttrib = 'GBIF contributors',
      gbif       = new L.TileLayer(gbifUrl, { minZoom: CONFIG.minZoom, maxZoom: CONFIG.maxZoom , attribution: gbifAttrib });

      var overlays = { "GBIF": gbif };

      var map = L.map('map', {
        center: CONFIG.center,
        zoom: CONFIG.defaultZoom,
        layers: [minimal, gbif],
        zoomControl: false
      });

      setupZoom(map);
      bboxes = null;

      // draw the bounding boxes should they exist (for example from a geographic coverage in the dataset)
      if (bboxes != null) {
        // bboxes have minLat,maxLat,minLng,maxLng
        $.each(bboxes, function(index, box) {
      	  // handle boxes that are really points
      	  if (box[0]==box[1] && box[2]==box[3]) {
	        L.marker([box[0], box[2]]).addTo(map);
      	  } else {
        	var bounds = [[box[0], box[2]], [box[1], box[3]]];
            L.rectangle(bounds, {color: "#ff7800", weight: 2}).addTo(map);
            // Some small boxes don't show, so provide a marker
            L.marker([box[0] + ((box[1]-box[0])/2), box[2] + ((box[3]-box[2])/2)]).addTo(map);
      	  }

      	});
      }

      L.control.layers(baseLayers, overlays).addTo(map);

    } else if ($('body').hasClass('pointmap')) {

      console.log("Rendering pointmap");

      var map = L.map('map', {
        center: CONFIG.center,
        zoom: CONFIG.defaultZoom,
        layers: [minimal],
        zoomControl: false
      });

      setupZoom(map);

      var baseLayers = {
        "Classic":    gbifBase,
        "Minimal":    minimal,
        "Night View": midnight
      };

      L.control.layers(baseLayers, overlays).addTo(map);

      var // coordinates
      lat = $('#map').attr('latitude'),
      lng = $('#map').attr('longitude');

      if (lat != null && lng != null) {
        L.marker([lat, lng]).addTo(map);
        map.setView([lat, long], 4);
      }

    }
  }
});
