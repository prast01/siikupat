var base_url = $(location).attr("pathname");
base_url.indexOf(1);
base_url.toLowerCase();
base_url =
  window.location.origin === "http://sikupat.mi-kes.net"
    ? base_url.split("/")[1] + "/"
    : base_url.split("/")[1] + "/" + base_url.split("/")[2] + "/";
var url = window.location.origin + "/" + base_url;

var dash = $(location).attr("pathname");
dash.indexOf(1);
dash.toLowerCase();
dash =
  window.location.origin === "http://sikupat.mi-kes.net"
    ? dash.split("/")[2]
    : dash.split("/")[3];



console.log(dash);

$(function () {

    $(".datatable-odp").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: url + "data_odp",
        type: "POST",
        },
        order: [
        [1, "desc"],
        [7, "asc"],
        ],
    });

    $(".datatable").DataTable();
    //Initialize Select2 Elements
    $(".select2").select2();

    $(".textarea").summernote({
        height: 200
    });

    // $('.tanggal').datetimepicker({
    //         maxDate: new Date(),
    //         locale:'id',
    //         format:'YYYY-MM-DD'
    // });
    
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

    var GetChartData2 = function () {
        $.ajax({
            url: url + "service/data_kinerja",
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];
                for (var i in data) {
                    label.push(data[i].nama);
                    value.push(data[i].persen);
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

                console.log(chart.data.datasets);
            }
        });
    };

    var GetChartData3 = function () {
        $.ajax({
            url: url + "service/data_kinerja_akumulasi",
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];
                for (var i in data) {
                    label.push(data[i].nama);
                    value.push(data[i].persen);
                }
                var ctx = $('#barChart').get(0).getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Persentase (%)',
                            backgroundColor: 'rgb(56, 132, 255)',
                            borderColor: 'rgb(255, 255, 255)',
                            data: value
                        }]
                    },
                    options: barChartOptions
                });

                console.log(chart.data.datasets);
            }
        });
    };

    var GetChartData2_all = function () {
        $.ajax({
            url: url + "service/data_kinerja_all",
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $("#total_real").html(data.total_real);
                $("#total_rak").html(data.total_rak);
            }
        });
    };

    var GetChartData3_all = function () {
        $.ajax({
            url: url + "service/data_kinerja_akumulasi_all",
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $("#total_real").html(data.total_real);
                $("#total_rak").html(data.total_rak);
            }
        });
    };

    if (dash === "dashboard") {
        GetChartData();
    }

    if (dash === "grafik-kinerja") {
        GetChartData2();
        GetChartData2_all();
    }

    if (dash === "grafik-kinerja-akumulasi") {
        GetChartData3();
        GetChartData3_all();
    }

    if (dash === "spj") {
        getAntrian(1000);
    }

    if (dash === "verifikasi") {
        getAntrianVerif(1000);
    }

    $(".file-upload").change(function(){
        var file = this.files[0];
        if (file.type.match('application/pdf')) {
            $(".file-name").text(file.name);
            $("#dokumen_up").val("1");
        } else {
            alert("Format File Tidak Diijinkan");
            $(".file-upload").val("");
            $(".file-name").text("Pilih File");
        }
    });
});

// MODAL
function modalDefault(title, link, id = "") {
    $("#modal-default").modal();
    $(".modal-title").html(title);
    var origin = url + "modal/" + link + "/" + id;
    $.ajax({
        type: "POST",
        url: origin,
        success: function (data) {
            $(".body").html(data);
        },
        error: function (data) {
            $(".body").html("");
        }
    });
}

function modalXl(title, link, id = "") {
    $("#modal-xl").modal();
    $(".modal-title").html(title);
    var origin = url + "modal/" + link + "/" + id;
    $.ajax({
        type: "POST",
        url: origin,
        success: function (data) {
            $(".body").html(data);
        },
        error: function (data) {
            $(".body").html("");
        }
    });
}

// END MODAL

// FUNC
function get_rekening(id){
    var origin = url + "service/get_rekening/" + id;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data)
            var html = '';
            var html2 = '<option value="" selected disabled>Pilih</option>';
            var i;
            html += '<option value="" selected disabled>Pilih</option>';
            for(i=0; i<data.length; i++){
                html += '<option value='+data[i].id_rekening+'>'+data[i].nama_rekening+'</option>';
            }
            $('#id_rekening').html(html);
            $('#id_rok').html(html2);
            $("#uraian").val("")
            $("#nominal").val("")
        },
        error: function () {
            $("#id_rekening").html("");
        }
    });
}

function get_rok(id){
    var tgl = $("#tgl_kegiatan").val();
    var id_sub = $("#id_sub_kegiatan").val();
    var origin = url + "service/get_rok/" + id_sub + "/" + id + "/" + tgl;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data.length)
            var html = '';
            var i;
            html += '<option value="" selected disabled>Pilih</option>';
            if(data.length != 0){
                for(i=0; i<data.length; i++){
                    if (data[i].valid == 1) {
                        html += '<option value=' + data[i].id_rok + '>' + data[i].nominal + ' - ' + data[i].uraian + '</option>';
                    }
                }
            }
            $('#id_rok').html(html);
            $("#uraian").val("")
            $("#nominal").val("")
        },
        error: function () {
            var html = '';
            html += '<option value="" selected disabled>Pilih</option>';
            $('#id_rok').html(html);
        }
    });
}

function get_rok_a21(id){
    var tgl = $("#tgl_kegiatan").val();
    var id_sub = $("#id_sub_kegiatan").val();
    var origin = url + "service/get_rok_a21/" + id_sub + "/" + id + "/" + tgl;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data.length)
            var html = '';
            var i;
            html += '<option value="" selected disabled>Pilih</option>';
            if(data.length != 0){
                for(i=0; i<data.length; i++){
                    if (data[i].valid == 1) {
                        html += '<option value=' + data[i].id_rok + '>' + data[i].nominal + ' - ' + data[i].uraian + '</option>';
                    }
                }
            }
            $('#id_rok').html(html);
            $("#uraian").val("")
            $("#nominal").val("")
        },
        error: function () {
            var html = '';
            html += '<option value="" selected disabled>Pilih</option>';
            $('#id_rok').html(html);
        }
    });
}

function get_rok_ubah(id){
    var id_rok = $("#rok_hidden").val();
    var id_rek = $("#rek_hidden").val();
    var tgl = $("#tgl_kegiatan").val();
    var id_sub = $("#id_sub_kegiatan").val();
    var origin = url + "service/get_rok_ubah/" + id_sub + "/" + id + "/" + tgl;
    $.ajax({
        type: "POST",
        url: origin,
        data: {id_rok: id_rok, id_rek: id_rek},
        dataType: "json",
        success: function (data) {
            console.log(data)
            var html = '';
            var i;
            html += '<option value="" selected disabled>Pilih</option>';
            if(data.length != 0){
                for(i=0; i<data.length; i++){
                    if (data[i].valid == 1) {
                        html += '<option value=' + data[i].id_rok + '>' + data[i].nominal + ' - ' + data[i].uraian + '</option>';
                    }
                }
            }
            $('#id_rok').html(html);
        },
        error: function () {
            var html = '';
            html += '<option value="" selected disabled>Pilih</option>';
            $('#id_rok').html(html);
        }
    });
}

function get_uraian(id){
    var origin = url + "service/get_uraian/" + id;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data)
            $("#uraian").val(data.uraian)
            $("#nominal").val(data.nominal)
            $("#uraian").focus()
        },
        error: function () {
            $("#uraian").val("")
            $("#nominal").val("")
        }
    });
}

function add_pelaksana() {
    var id_pegawai = $("#id_pegawai").val();
    var pihak_ketiga = $("#pihak_ketiga").val();
    var nominal = $("#nominal_pelaksana").val();
    
    var origin = url + "service/set_pelaksana/" + id_pegawai + "/" + nominal;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data)
            var nama = "";
            if(id_pegawai == "128") {
                nama = pihak_ketiga;
            } else {
                nama = data.nama_pegawai;
            }

            var html = "";
            html += "<tr id='" + data.id_row + "'>";
            html += "<td>" + nama + "</td>";
            html += "<td>" + data.nominal + "</td>";
            html += "<td>";
            html += "<input type='hidden' name='id_pelaksana[]' value='" + id_pegawai + "'>";
            html += "<input type='hidden' name='pihak_ketiga[]' value='" + pihak_ketiga + "'>";
            html += "<input type='hidden' name='nominal_pelaksana[]' value='" + nominal + "'>";
            html += '<button type="button" onclick="remove_pelaksana(\'' + data.id_row + '\')\" class="btn btn-danger btn-sm">';
            html += "<span class='fa fa-trash'></span>";
            html += "</button>";
            html += "</tr>";
            if (id_pegawai != "" && nominal != "") {
                $("#table-pelaksana tbody").append(html);                
            }
        },
        error: function () {
        }
    });
}

function remove_pelaksana(id) {
    $("#" + id).remove();
}

function get_seksi(id){
    var origin = url + "service/get_seksi/" + id;
    $.ajax({
        type: "POST",
        url: origin,
        dataType: "json",
        success: function (data) {
            console.log(data)
            var html = '';
            var i;
            html += '<option value="all" selected>Semua</option>';
            if(data.length != 0){
                for(i=0; i<data.length; i++){
                    html += '<option value=' + data[i].kode_seksi + '>' + data[i].nama + '</option>';
                }
            }
            $('#kode_seksi').html(html);
        },
        error: function () {
            var html = '';
            html += '<option value="" selected>Semua</option>';
            $('#kode_seksi').html(html);
        }
    });
}

function getAntrian(waktu) {
    var origin = url + "service/get_antrian";
    setTimeout(function(){
        $.ajax({
            type: "POST",
            url: origin,
            dataType: "json",
            success: function (data) {
                console.log(data)
                $('#antrian').html(data.no_spj);
                $('#total').html(data.total);
                getAntrian(30000)
            },
            error: function () {
                $('#antrian').html("XXXX");
                $('#total').html("XX");
            }
        });
    }, waktu);
}

function getAntrianVerif(waktu) {
    var status = $("#status_spj").val();
    var origin = url + "service/get_antrian_verif/" + status;
    setTimeout(function(){
        $.ajax({
            type: "POST",
            url: origin,
            dataType: "json",
            success: function (data) {
                console.log(data)
                $('#baru').html(data.baru);
                $('#revisi').html(data.revisi);
                $('#acc').html(data.acc);
                getAntrianVerif(30000)
            },
            error: function () {
                $('#baru').html("XX");
                $('#revisi').html("XX");
                $('#acc').html("XX");
            }
        });
    }, waktu);
}

function getGrafikKinerja() {
    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }
    var arr_bln = {
        "01" : "Januari",
        "02" : "Februari",
        "03" : "Maret",
        "04" : "April",
        "05" : "Mei",
        "06" : "Juni",
        "07" : "Juli",
        "08" : "Agustus",
        "09" : "September",
        "10" : "Oktober",
        "11" : "November",
        "12" : "Desember"
    };
    var kode_bidang = $("#kode_bidang").val();
    var bulan = $("#bulan").val();
    var bulan_terpilih = arr_bln[bulan];
    $.ajax({
        url: url + "service/data_kinerja/" + kode_bidang + "/" + bulan,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#barChart').remove(); // this is my <canvas> element
            $('#barContainer').append('<canvas id="barChart" style="height:530px; min-height:230px"></canvas>');
            // console.log(data);
            var label = [];
            var value = [];
            for (var i in data) {
                label.push(data[i].nama);
                value.push(data[i].persen);
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
            
            $("#namaBulan").html(bulan_terpilih.toUpperCase());
            getTotalKinerja("data_kinerja_all", kode_bidang, bulan);
        }
    });
}

function getGrafikKinerjaAkumulasi() {
    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }
    var arr_bln = {
        "01" : "Januari",
        "02" : "Februari",
        "03" : "Maret",
        "04" : "April",
        "05" : "Mei",
        "06" : "Juni",
        "07" : "Juli",
        "08" : "Agustus",
        "09" : "September",
        "10" : "Oktober",
        "11" : "November",
        "12" : "Desember"
    };
    var kode_bidang = $("#kode_bidang").val();
    var bulan = $("#bulan").val();
    var bulan_terpilih = arr_bln[bulan];
    $.ajax({
        url: url + "service/data_kinerja_akumulasi/" + kode_bidang + "/" + bulan,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#barChart').remove(); // this is my <canvas> element
            $('#barContainer').append('<canvas id="barChart" style="height:530px; min-height:230px"></canvas>');
            // console.log(data);
            var label = [];
            var value = [];
            for (var i in data) {
                label.push(data[i].nama);
                value.push(data[i].persen);
            }
            var ctx = $('#barChart').get(0).getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Persentase (%)',
                        backgroundColor: 'rgb(56, 132, 255)',
                        borderColor: 'rgb(255, 255, 255)',
                        data: value
                    }]
                },
                options: barChartOptions
            });
            
            $("#namaBulan").html(bulan_terpilih.toUpperCase());
            getTotalKinerja("data_kinerja_akumulasi_all", kode_bidang, bulan);
        }
    });
}

function getTotalKinerja(data, kode_bidang, bulan) {
    $.ajax({
        url: url + "service/" + data + "/" + kode_bidang + "/" + bulan,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            $("#total_real").html(data.total_real);
            $("#total_rak").html(data.total_rak);
        }
    });
}