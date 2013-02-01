var is_ie = $.browser.msie;
var broswer_version = parseInt($.browser.version, 10);
var oldIE = is_ie && $.browser.version.substr(0, 1) < 9;

String.prototype.toProperCase = function () {
  return this.replace(/\w\S*/g, function(txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
};

// Original function by Alien51
Array.prototype.unique = function () {
    var arrVal = this;
    var uniqueArr = [];
    for (var i = arrVal.length; i--; ) {
        var val = arrVal[i];
        if ($.inArray(val, uniqueArr) === -1) {
            uniqueArr.unshift(val);
        }
    }
    return uniqueArr;
}

function addCommas(str) {
    var amount = new String(str);
    amount = amount.split("").reverse();

    var output = "";
    for ( var i = 0; i <= amount.length-1; i++ ){
        output = amount[i] + output;
        if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = ',' + output;
    }
    return output;
}

function generateRandomValues(limit) {
  var last = Math.floor(Math.random() * 500);
  var random = 0;
  var values = [];
  var s = 0;

  for (var i = 0; i <= limit; i++) {
    s = Math.floor(Math.random() * 100);

    if (s > 80 && s < 90) {
      random = last + Math.floor(Math.random() * last);
      values[i] = random;
    } else if (s > 95) {
      random = last - Math.floor(Math.random() * last);
      values[i] = random;
    } else {
      values[i] = last + Math.floor(Math.random() * 100);
    }
    last = values[i];
  }
  return values;
}


function sortByCount($ul) {
  $ul.find(" > li").sortList(function(a, b) {
    return parseInt($(a).attr("data")) > parseInt($(b).attr("data")) ? 1 : -1;
  });

  $ul.children().each(function() {
    sortByCount($(this))
  });
}

function sortAlphabetically($ul) {
  $ul.find(" > li").sortList(function(a, b) {
    return $(a).find("span").text() > $(b).find("span").text() ? 1 : -1;
  });

  $ul.children().each(function() {
    sortAlphabetically($(this));
  });
}

/**
 * jQuery.fn.sort
 * --------------
 * @author James Padolsey (http://james.padolsey.com)
 * @version 0.1
 * @updated 18-MAR-2010
 * --------------
 * @param Function comparator:
 *   Exactly the same behaviour as [1,2,3].sort(comparator)
 *
 * @param Function getSortable
 *   A function that should return the element that is
 *   to be sorted. The comparator will run on the
 *   current collection, but you may want the actual
 *   resulting sort to occur on a parent or another
 *   associated element.
 *
 *   E.g. $('td').sort(comparator, function(){
 *      return this.parentNode;
 *   })
 *
 *   The <td>'s parent (<tr>) will be sorted instead
 *   of the <td> itself.
 */
jQuery.fn.sortList = (function() {

  var sort = [].sort;

  return function(comparator, getSortable) {

    getSortable = getSortable || function() {
      return this;
    };

    var placements = this.map(function() {

      var sortElement = getSortable.call(this),
        parentNode = sortElement.parentNode,

        // Since the element itself will change position, we have
        // to have some way of storing it's original position in
        // the DOM. The easiest way is to have a 'flag' node:
        nextSibling = parentNode.insertBefore(document.createTextNode(''), sortElement.nextSibling);

      return function() {

        if (parentNode === this) {
          throw new Error("You can't sort elements if any one is a descendant of another.");
        }

        // Insert before flag:
        parentNode.insertBefore(this, nextSibling);
        // Remove flag:
        parentNode.removeChild(nextSibling);

      };

    });

    return sort.call(this, comparator).each(function(i) {
      placements[i].call(getSortable.call(this));
    });

  };

})();


function setupZoom(map) {
  var minZoom = 0;

  $(".zoom_in").on("click", function() {
    map.setZoom(map.getZoom() + 1);
  });

  $(".zoom_out").on("click", function() {
    var zoom;

    if ( map.getZoom() > minZoom ) {
      map.setZoom(map.getZoom() - 1);
    }

  });
}


/**
 * javascript version of NameUsage.getCanonicalOrScientificName()
 */
function canonicalOrScientificName(usage) {
  if (usage.canonicalName) {
    return usage.canonicalName;
  }
  return usage.scientificName;
}
