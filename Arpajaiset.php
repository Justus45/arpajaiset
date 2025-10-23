<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <title>Arpajaisiin osallistuminen</title>
      <link rel="stylesheet" href="arvotut.css">
</head>
<body align="center">
    <h2>Arpajaisiin osallistuminen</h2>
    <form method="POST" action="">
        <label for="nimi">Nimi:</label>
        <input type="text" id="nimi" name="nimi" required><br>
        
        <label for="sahkoposti">Sähköpostiosoite:</label>
        <input type="email" id="sahkoposti" name="sahkoposti" required><br>
        
        <label for="puhelinnumero">Puhelinnumero:</label>
        <input type="text" id="puhelinnumero" name="puhelinnumero" required><br>
        
        <button type="submit">Osallistu</button>
    </form>
</body>
<?php
function tarkistaSahkoposti($sahkoposti) {
    
    return strpos($sahkoposti, '@') !== false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nimi = htmlspecialchars($_POST["nimi"]);
    $sahkoposti = htmlspecialchars($_POST["sahkoposti"]);
    $puhelinnumero = htmlspecialchars($_POST["puhelinnumero"]);

    
    if (!tarkistaSahkoposti($sahkoposti)) {
        echo "<p>Virhe: Sähköpostiosoitteessa tulee olla @-merkki.</p>";
        exit;
    }

   
    $arpanumero = rand(1, 10000);

   
    $tiedosto = fopen("arvotut.txt", "a");
    fwrite($tiedosto, "$nimi;$sahkoposti;$puhelinnumero;$arpanumero\n");
    fclose($tiedosto);

    // Näytetään käyttäjän tiedot
    echo "<h3>Osallistumistietosi</h3>";
    echo "<p>Nimi: $nimi</p>";
    echo "<p>Sähköposti: $sahkoposti</p>";
    echo "<p>Puhelinnumero: $puhelinnumero</p>";
    echo "<p>Arpanumero: $arpanumero</p>";
    echo "<a href='Arpajaiset.php'>Paluu</a>";
}
?>
</html>