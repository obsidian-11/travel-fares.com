$(document).ready(function () {
  $("#departuredate").val(moment().add(3, "days").format("MMM-DD-YYYY"));
  $("#returndate").val(moment().add(10, "days").format("MMM-DD-YYYY"));
  rangepicker(false);
  $(".count").click(function (e) {
    var button_classes = $(e.currentTarget).prop("class");
    var btn = $(this),
      oldValue = btn.closest(".number-spinner").find("input").val().trim(),
      newVal = 0,
      minVal = 0;
    var adt = parseInt($("#AdultsRT").val(), 10),
      chd = parseInt($("#ChildrenRT").val(), 10),
      inf = parseInt($("#InfantsST").val(), 10);
    var nm = btn.closest(".number-spinner").find("input").attr("name").trim();
    if (nm == "adults") {
      minVal = 1;
    }
    if (button_classes.indexOf("up_count") !== -1) {
      newVal = parseInt(oldValue) + 1;
    } else {
      if (oldValue > minVal) {
        newVal = parseInt(oldValue) - 1;
      } else {
        newVal = minVal;
      }
    }
    if (
      (adt + chd + inf >= 9 || (inf >= adt && nm == "InfantsST")) &&
      button_classes.indexOf("up_count") !== -1
    ) {
    } else if (
      inf == adt &&
      button_classes.indexOf("down_count") !== -1 &&
      nm == "adults"
    ) {
    } else {
      btn.closest(".number-spinner").find("input").val(newVal);
    }
  });

  $(".pes-txt").click(function () {
    $(".pop-box").toggle(1000);
  });
  all_pesenger();
  $.ajax({
    type: "POST",
    url: "gtdata.aspx/homeoffers",
    async: false,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function (response) {
      var h = "",
        _offrs = [];
      try {
        _offrs = JSON.parse(
          response.d.substring(1, response.d.length - 2) + "}"
        ).Table;
      } catch (e) {}
      $("div[data-fr]").each(function () {
        var _dfrom = $(this).attr("data-fr");
        var _offr = $.grep(_offrs, function (n, i) {
          return _dfrom.indexOf(n.destfrom) >= 0;
        });
        h = "";
        var cnt = 0;
        $.each(_offr, function () {
          if (cnt < 9) {
            h += '<div class="col-lg-4 col-md-6 col-sm-12 mb-4">';
            h +=
              '<div style="cursor:pointer;" onclick="sbmt(\'' +
              this.destfrom +
              "','" +
              this.destto +
              "','" +
              this.ddate +
              "','" +
              this.rdate +
              "');\">";
            h += '<div class="ft-box">';
            h += '<div class="row">';
            h += '<div class="col-4">';
            h +=
              '<span class="pl-name ex" data-bs-toggle="tooltip" data-bs-placement="top" title="' +
              this.destfromname +
              '">' +
              this.destfromname +
              "</span>";
            h += '<span class="date-sm ex">' + this.ddate + "</span>";
            h += "</div>";
            h += '<div class="col-1 text-center ps-0 pe-0">';
            h +=
              '<span class="round-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 512 512"><title>Swap Horizontal</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M304 48l112 112-112 112M398.87 160H96M208 464L96 352l112-112M114 352h302"/></svg></span>';
            h += "</div>";
            h += '<div class="col-4">';
            h +=
              '<span class="pl-name ex" data-bs-toggle="tooltip" data-bs-placement="top" title="' +
              this.desttoname +
              '">' +
              this.desttoname +
              "</span>";
            h += '<span class="date-sm ex">' + this.rdate + "</span>";
            h += "</div>";
            h += '<div class="col-3 border-start">';
            h +=
              '<span class="price-rate">$' +
              Math.floor(parseFloat(this.total, 10)) +
              "</span>";
            h += "</div>";
            h += "</div>";
            h += "</div>";
            h += "</div>";
            h += "</div>";
          }
          cnt++;
        });
        $(this).append(h);
      });
    },
    error: function (err) {
      // console.log("error");
    },
  });
});
jQuery(function ($) {
  var arr = [];
  $.getJSON("/js/airport.json", function (data) {
    $.each(data, function (key, value) {
      var codes = value.substring(0, 3);
      if ($.inArray(value, arr) === -1) {
        arr.push(value);
      }
    });
  });
  $("#locationd").autocomplete({
    source: function (request, response) {
      var stringLength = $.ui.autocomplete.escapeRegex(request.term).length;
      var matcher = new RegExp(
        "^" + $.ui.autocomplete.escapeRegex(request.term),
        "i"
      );
      var matcher2 = new RegExp(
        $.ui.autocomplete.escapeRegex(request.term) + "+",
        "i"
      );
      var isData = 1;
      response(
        $.grep(arr, function (item) {
          if (stringLength <= 3) {
            if (matcher.test(item)) {
              isData = 22;
            }
            return matcher.test(item);
          } else {
            if (matcher2.test(item)) {
              isData = 22;
            }
            return matcher2.test(item);
          }
        })
      );
      if (stringLength == 3 && isData == 1) {
        response(
          $.grep(arr, function (item) {
            return matcher2.test(item);
          })
        );
      }
    },
    minLength: 1,
  });
  $("#locationd2").autocomplete({
    source: function (request, response) {
      var stringLength = $.ui.autocomplete.escapeRegex(request.term).length;
      var matcher = new RegExp(
        "^" + $.ui.autocomplete.escapeRegex(request.term),
        "i"
      );
      var matcher2 = new RegExp(
        $.ui.autocomplete.escapeRegex(request.term) + "+",
        "i"
      );
      var isData = 1;
      response(
        $.grep(arr, function (item) {
          if (stringLength <= 3) {
            if (matcher.test(item)) {
              isData = 22;
            }
            return matcher.test(item);
          } else {
            if (matcher2.test(item)) {
              isData = 22;
            }
            return matcher2.test(item);
          }
        })
      );
      if (stringLength == 3 && isData == 1) {
        response(
          $.grep(arr, function (item) {
            return matcher2.test(item);
          })
        );
      }
    },
    minLength: 1,
  });
});
function sbmt(fr, to, dd, rd) {
  $("#locationd").val(fr);
  $("#locationd2").val(to);
  $("#departuredate").val(dd);
  $("#returndate").val(rd);
  $("#tripType").val("roundtrip");
  $("#classType").val("ECONOMY");
  $("#AdultsRT").val(1);
  $("#ChildrenRT").val(0);
  $("#InfantsST").val(0);
  $("#frmsearch").submit();
}
function all_pesenger() {
  var infow = $("#InfantsST").val();
  var childow = $("#ChildrenRT").val();
  var adultow = $("#AdultsRT").val();
  var total = +infow + +childow + +adultow;
  var strpx = adultow + " Adults";
  if (childow > 0) {
    strpx += ", " + childow + " Children";
  }
  if (infow > 0) {
    strpx += ", " + infow + " Infants";
  }
  $(".pes-txt").val(strpx);
  $(".pop-box").hide(1000);
  return total;
}

function rangepicker(sin) {
  var start = moment().add(1, "days");
  var end = moment().add(1, "years");
  $('input[name="daterange"]').daterangepicker(
    {
      singleDatePicker: true,
      opens: "left",
      minDate: start,
      maxDate: end,
      autoApply: true,
      startDate: moment().add(3, "days"),
      endDate: moment().add(10, "days"),
      locale: {
        format: "MMM DD, YYYY",
      },
      singleDatePicker: sin,
    },
    function (start, end, label) {
      $("#departuredate").val(start.format("MMM-DD-YYYY"));
      $("#returndate").val(end.format("MMM-DD-YYYY"));
      //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    }
  );
}
function setCookie() {
  var org = $("#locationd").val();
  //alert(org);
  var dest = $("#locationd2").val();
  var depart = $("#depDt").val();
  var arr = $("#retDt").val();
  var adt = $("#AdultsRT").val();
  var chd = $("#ChildrenRT").val();
  var inf = $("#InfantsST").val();
  var trip = $(".tripType").val();

  var tripType = "";
  if (document.getElementsByClassName("tripType")) {
    var airlineElements = document.getElementsByClassName("tripType");
    for (var i = 0; airlineElements[i]; ++i) {
      if (airlineElements[i].checked) {
        //tripType.push(airlineElements[i].value); //for checkboxes
        tripType = airlineElements[i].value;
      }
      //alert(filterAirlines);
    }
  }
  $(".waitingdiv").show();
  return true;
}
function show_date(data) {
  if (data == "oneway") {
    rangepicker(true);
  } else if (data == "roundtrip") {
    rangepicker(false);
  }
}

// tooltip js trigger

var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});
