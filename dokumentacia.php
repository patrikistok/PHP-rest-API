<!DOCTYPE html>
<html lang = "sk">

<head>
    <title>Dokumentácia</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="cviko6.css">
</head>

<body>
    <div class="text-center">
            <button type = "button" class="btn btn-info btn-lg" onclick = "location.href = 'index.php';">Klientska strana API</button>
    </div>
    <h2 class="podnadpis">Dokumentácia REST API</h2>
    <div class="text-center">
        <p id="urlLink">URL: https://wt65.fei.stuba.sk/cviko6</p>
    </div>

    <div id="dokumentacia">
        <table id="tabulka">
            <thead>
                <tr>
                    <th>Funkcia</th>
                    <th>Metóda</th>
                    <th>Endpoint</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Získanie menín pre dátum</td>
                    <td>GET</td>
                    <td>URL/names/?day={deň}&month={mesiac}&code={kód}</td>
                    <td>deň=celé číslo 1 až 31,
                        mesiac=celé číslo 1 až 12,
                        kód={SK, CZ, AT, PL, HU}
                    </td>
                </tr>
                <tr>
                    <td>Získanie dátumu menín pre meno</td>
                    <td>GET</td>
                    <td>URL/nameday/?name={meno}&code={kód}</td>
                    <td>meno= meno s diakritikou (napr. Šimon),
                        kód={SK, CZ, AT, PL, HU}
                    </td>
                </tr>
                <tr>
                    <td>Získanie sviatkov krajiny(len SK a CZ)</td>
                    <td>GET</td>
                    <td>URL/holidays/?code={kód}</td>
                    <td>kód={SK, CZ}</td>
                </tr>
                <tr>
                    <td>Získanie pamätných dní(len SK)</td>
                    <td>GET</td>
                    <td>URL/memdays/?code={kód}</td>
                    <td>kód={SK}</td>
                </tr>
                <tr>
                    <td>Pridanie mena do SK kalendára</td>
                    <td>POST</td>
                    <td>URL/createNameday/</td>
                    <td>Post dáta vo formáte json (napr. {
    "name":"Ahoj",
    "day":1,
    "month":1})</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>