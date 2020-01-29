function getValues() {
    var time = "1min";
    var symbol = "msft";
    const API_KEY = "RXBI58CV94UNIRQS";
    var urlApi = "https://www.alphavantage.co/query";
    $("#dados").html('<img src="./assets/img/sistem/loading.gif" class="rounded-circle" alt="Cinque Terre"></img>');

    $.get(
            urlApi, {
                function: "TIME_SERIES_INTRADAY",
                symbol: symbol,
                interval: time,
                apikey: API_KEY
            },
            function(data) {
                postValue(data, time, symbol);
            }
        )
        .fail(function() {
            alert("Erro! não foi possivel realizar a comunicação.");
        });

}

function postValue(data, time, symbol) {
    var postUrl = "./assets/dashboard/dashboard.php";
    var infoValues = data['Time Series (' + time + ')'];

    $.post(
            postUrl, {
                posttime: JSON.stringify(infoValues),
                symbol: symbol
            },
            function(data) {

            }
        )
        .done(function() {
            getInfo();
        })
        .fail(function(dados) {
            alert("Erro! Não foi possivel gravar os dados no banco");
        });


}

function getInfo() {
    var symbol = "msft";
    var getUrl = "./assets/dashboard/dashboard.php";

    $.get(
            getUrl, {
                readValue: symbol,
                ini: 0,
                fim: 100
            },
            function(data) {
                //console.log(data);
                data = JSON.parse(data);

                const MAX = 10;
                var vI = 0;


                var table = "<table class='table table-hover'>";
                table += "<thead>";
                table += "<tr>";
                table += "<th>Data Hora</th>";
                table += "<th>Abertura</th>";
                table += "<th>Maxima</th>";
                table += "<th>Minima</th>";
                table += "<th>Fechamento</th>";
                table += "<th>Volume</th>";
                table += "</tr>";
                table += "</thead>";
                table += "<tbody>";
                //console.log(data);
                for (let info of data) {
                    table += "<tr>";
                    table += "<th>" + info.date + "</th>";
                    table += "<th>" + info.open + "</th>";
                    table += "<th>" + info.high + "</th>";
                    table += "<th>" + info.low + "</th>";
                    table += "<th>" + info.close + "</th>";
                    table += "<th>" + info.volume + "</th>";
                    table += "</tr>";
                }
                /*
                table += '<tr><td colspan="6"><ul class="pagination justify-content-center" >'
                table += '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';
                table += '<li class="page-item"><a class="page-link" href="#">1</a></li>'
                table += '<li class="page-item"><a class="page-link" href="#">2</a></li>';
                table += '<li class="page-item"><a class="page-link" href="#">3</a></li>';
                table += '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
                table += '</ul></td></tr>';
                */
                table += "</tbody>";
                table += "</tbody>";
                table += "</table>";

                $("#dados").html(table);
            }
        )
        .fail(function(dados) {
            alert("Erro! Não foi possivel li    star as informações na tela.");
        });
}


$(document).ready(function() {
    getValues();
});