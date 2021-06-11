var base_url = $(location).attr("pathname");
base_url.indexOf(1);
base_url.toLowerCase();
base_url =
  window.location.origin === "http://sikupat.sikdkk.jepara.go.id"
    ? base_url.split("/")[1] + "/"
    : base_url.split("/")[1] + "/" + base_url.split("/")[2] + "/";
var url = window.location.origin + "/" + base_url;

var dash = $(location).attr("pathname");
dash.indexOf(1);
dash.toLowerCase();
dash =
  window.location.origin === "http://sikupat.sikdkk.jepara.go.id"
    ? dash.split("/")[2]
    : dash.split("/")[3];

console.log(url);

$(function () {
  // var url = window.location.origin + "/laporkan-v2/datatables/";

  $(".datatable").DataTable();
  //Initialize Select2 Elements
  $(".select2").select2();

  
	var barChartOptions = {
		responsive              : true,
		maintainAspectRatio     : false,
		datasetFill             : false
	}

	var GetChartData = function () {
		$.ajax({
			url: url + "service/data_realisasi",
			method: 'GET',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				var label = [];
				var value = [];
				for (var i in data) {
					label.push(data[i].nama);
					value.push(data[i].persen_anggaran);
				}
				var ctx = $('#barChart').get(0).getContext('2d');
				var chart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: label,
						datasets: [{
							label: 'Persentase (%)',
							backgroundColor: 'rgb(252, 116, 101)',
							borderColor: 'rgb(255, 255, 255)',
							data: value
						}]
					},
					options: barChartOptions
				});
			}
		});
	};

    if (dash === "dashboard") {
        GetChartData();
    }
    
});

// MODAL
function modalDefault(title, link) {
  $("#modal-default").modal();
  $(".modal-title").html(title);
  var origin = url + "modal/" + link;
  $.ajax({
    type: "POST",
    url: origin,
    success: function (data) {
      $(".body").html(data);
    },
  });
}

function modalXl(title, link) {
  $("#modal-xl").modal();
  $(".modal-title").html(title);
  var origin = url + "modal/" + link;
  $.ajax({
    type: "POST",
    url: origin,
    success: function (data) {
      $(".body").html(data);
    },
  });
}

// END MODAL

function positif(id, kondisi) {
  var url = window.location.origin + "/laporkan-v2/home/positif/";
  // if (kondisi == '2') {
  var cek = confirm("Yakin Pasien Positif COVID-19?");
  if (cek) {
    window.location = url + id + "/" + kondisi;
  }
  // }
}