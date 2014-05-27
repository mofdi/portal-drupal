function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
jQuery(document).ready(function($) {
	$.getJSON('http://api.gbif.org/v0.9/occurrence/count?callback=?', function (data)
	{ $("#countOccurrences").html(numberWithCommas(data)); }
	);
	$.getJSON('http://api.gbif.org/v0.9/species/search?dataset_key=7ddf754f-d193-4cc9-b351-99906754a03b&limit=1&rank=species&status=accepted&status=DOUBTFUL&callback=?', function (data)
	{ $("#countSpecies").html(numberWithCommas(data.count)); }
	);	
	$.getJSON('http://api.gbif.org/v0.9/dataset/search?limit=1&callback=?', function (data)
	{ $("#countDatasets").html(numberWithCommas(data.count)); }
	);
	$.getJSON('http://api.gbif.org/v0.9/organization/count?callback=?', function (data)
	{ $("#countPublishers").html(numberWithCommas(data)); }
	);
});
