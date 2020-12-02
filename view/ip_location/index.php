<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Ip Plats</h1>
<p>Skriv in en ip för att se dens plats</p>

    <form method="post">
        <input type="text" name="ip" value="<?= $clientip ?>">
        <input type="submit" value="Validera">
    </form>

    <form method="post">
        <input type="text" name="ip" value="8.8.8.8">
        <input type="submit" value="Test ip4">
    </form>

    <form method="post">
        <input type="text" name="ip" value="2001:4860:4860::8888">
        <input type="submit" value="Test ip6">
    </form>

<?php if ($result) : ?>
    <p>IP: <?= $result["ip"] ?></p>
    <p>Typ: <?= $result["type"] ?></p>
    <p>Plats: <?= $result["country_name"] . ", " . $result["city"] ?></p>
<?php endif; ?>

<h1>Ip Validator REST api</h1>

<p>För att hitta platsen på ett ip med mitt REST api så gör du ett call till</p>
<p>POST: http://www.student.bth.se/~adei18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/iplocationREST</p>
<p>Body ip="ip du vill validera"</p>

<form action="http://www.student.bth.se/~adei18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/iplocationREST" method="post">
    <input type="text" name="ip" value="8.8.8.8">
    <input type="submit" value="Test ip4">
</form>

<form action="http://www.student.bth.se/~adei18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/iplocationREST" method="post">
    <input type="text" name="ip" value="2001:4860:4860::8888">
    <input type="submit" value="Test ip6">
</form>
