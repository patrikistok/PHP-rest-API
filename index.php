<!DOCTYPE html>
<html lang = "sk">

<head>
    <title>Meniny</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="cviko6.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <script>

    $(document).ready(function() {

        $(document).on('click', '#ziskatMena', function(){
            let formular = $('#formMena').serializeArray();
            let den = formular[0]["value"];
            let mesiac = formular[1]["value"];
            let kod = formular[2]["value"];
            let url = "https://wt65.fei.stuba.sk/cviko6/names/?day=" + den + "&month=" + mesiac + "&code=" + kod;
            $.getJSON(url, function(data){
                document.getElementById("kontajnerOutput").innerHTML = "";
                $.each(data, function(i, obj) {
                document.getElementById("kontajnerOutput").innerHTML += obj.name +"<br>";
                });
                document.getElementById("kontajnerOutput").innerHTML += "<p>URL: <a href='" + url + "'>" + url + "</a>";
            });
        });

        $(document).on('click', '#ziskatMeniny', function(){
            let formular = $('#formMeniny').serializeArray();
            let meno = formular[0]["value"];
            let kod = formular[1]["value"];
            let url = "https://wt65.fei.stuba.sk/cviko6/nameday/?name=" + meno + "&code=" + kod;
            $.getJSON(url, function(data){
                document.getElementById("kontajnerOutput").innerHTML = "";
                $.each(data, function(i, obj) {
                document.getElementById("kontajnerOutput").innerHTML += obj.day + "." + obj.month + ". " +"<br>";
                });
                document.getElementById("kontajnerOutput").innerHTML += "<p>URL: <a href='" + url + "'>" + url + "</a>";
            });
        });

        $(document).on('click', '#ziskatSviatky', function(){
            let formular = $('#formSviatky').serializeArray();
            let kod = formular[0]["value"];
            let url = "https://wt65.fei.stuba.sk/cviko6/holidays/?code=" + kod;
            $.getJSON(url, function(data){
                document.getElementById("kontajnerOutput").innerHTML = "";
                $.each(data, function(i, obj) {
                document.getElementById("kontajnerOutput").innerHTML += obj.day + "." + obj.month + ". "  + obj.holiday +"<br>";
                });
                document.getElementById("kontajnerOutput").innerHTML += "<p>URL: <a href='" + url + "'>" + url + "</a>";
            });
        });

        $(document).on('click', '#ziskatDni', function(){
            let url = "https://wt65.fei.stuba.sk/cviko6/memdays/?code=SK";
            $.getJSON(url, function(data){
                document.getElementById("kontajnerOutput").innerHTML = "";
                $.each(data, function(i, obj) {
                document.getElementById("kontajnerOutput").innerHTML += obj.day + "." + obj.month + ". "  + obj.memorial_days +"<br>";
                });
                document.getElementById("kontajnerOutput").innerHTML += "<p>URL: <a href='" + url + "'>" + url + "</a>";
            });
        });

        //https://codeofaninja.com/2015/06/php-crud-with-ajax-and-oop.html
        $.fn.serializeObject = function(){
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        $(document).on('submit', '#pridatMeno', function(){
            var form_data=JSON.stringify($(this).serializeObject());
            $.ajax({
                url: "https://wt65.fei.stuba.sk/cviko6/createNameday/",
                type : "POST",
                contentType : 'application/json',
                data : form_data,
                success : function(result) {
                    alert("Meno pridané");
                },
                error: function(xhr, resp, text) {
                    alert("Error");
                }
            });
            return false;
        });
    });
    </script>

    <div class = "kontajnerForm">
        <h2 class="podnadpis">Výsledky hľadania:</h2>
        <div id="kontajnerOutput">
        </div>
        <hr>
        <div class="text-center">
            <button type = "button" class="btn btn-info btn-lg" onclick = "location.href = 'dokumentacia.php';">Dokumentácia</button>
        </div>
        <hr>
        <h2 class="podnadpis">Získanie menín pre daný dátum</h2>
        <form id="formMena">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="denMena">Deň: </label><br>
                    <input type="number" id="denMena" name="denMena" class="form-control" value="1" min="1" max = "31"><br>
                </div>
                <div class="col-md-3">
                    <label for="mesiacMena">Mesiac: </label><br>
                    <input type="number" id="mesiacMena" name="mesiacMena" class="form-control" value="1" min="1" max = "12"><br>
                </div>
                <div class="col-md-4">
                    <label for="krajinaMena">Krajina: </label><br>
                    <select name="krajinaMena" id="krajinaMena" class="form-control" form="formMena">
                        <option value="SK">Slovensko</option>
                        <option value="CZ">Česko</option>
                        <option value="HU">Maďarsko</option>
                        <option value="PL">Poľsko</option>
                        <option value="AT">Rakúsko</option>
                    </select>
                </div>
            </div>
        </form> 
        <div class="text-center">
            <button id="ziskatMena" class="btn btn-info btn-lg">Získať meniny</button>
        </div>
        <hr>
        <h2 class="podnadpis">Získanie dátumu menín pre dané meno</h2>
        <form id="formMeniny">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="menoMeniny">Meno: </label><br>
                    <input type="text" id="menoMeniny" name="menoMeniny" class="form-control"><br>
                </div>
                <div class="col-md-6">
                    <label for="krajinaMeniny">Krajina: </label><br>
                    <select name="krajinaMeniny" id="krajinaMeniny" class="form-control" form="formMeniny">
                        <option value="SK">Slovensko</option>
                        <option value="CZ">Česko</option>
                        <option value="HU">Maďarsko</option>
                        <option value="PL">Poľsko</option>
                        <option value="AT">Rakúsko</option>
                    </select>
                </div>
            </div>
        </form> 
        <div class="text-center">
            <button id="ziskatMeniny" class="btn btn-info btn-lg">Získať meniny</button>
        </div>
        <hr>
        <h2 class="podnadpis">Získanie sviatkov krajiny</h2>
        <form id="formSviatky">
            <div class="text-center">
                <label for="krajinaSviatky">Krajina: </label><br>
                <select name="krajinaSviatky" id="krajinaSviatky" class="form-control" form="formSviatky">
                    <option value="SK">Slovensko</option>
                    <option value="CZ">Česko</option>
                </select>
            </div> 
            <br>
        </form> 
        <div class="text-center">
                <button id="ziskatSviatky" class="btn btn-info btn-lg">Získať sviatky</button>
        </div>  
        <hr>
        <h2 class="podnadpis">Získanie pamätných dní na SK</h2>
        <div class="text-center">
            <button id="ziskatDni" class="btn btn-info btn-lg">Získať dni</button>
        </div>     
        <hr>
        <form id="pridatMeno" method="POST">
            <div> 
                <h2 class="podnadpis">Pridanie mena do SK kalendára</h2>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="name">Meno: </label><br>
                    <input type="text" name="name" id="name" class="form-control"><br>
                </div>

                <div class="col-md-3">
                    <label for="day">Deň: </label><br>
                    <input type="number" name="day" id="day" class="form-control" value="1" min="1" max = "31">
                </div>

                <div class="col-md-3">
                    <label for="month">Mesiac: </label><br>
                    <input type="number" name="month" id="month" class="form-control" value="1" min="1" max = "12">
                </div>
            </div>
            <div class="text-center">
                <button type = "submit" class="btn btn-info btn-lg">Pridaj meno</button>
            </div>
        </form>
    </div>
</body>
</html>