<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Ip Validator</h1>
<p>Skriv in en ip för att se om den validerar</p>

    <form method="post">
        <input type="text" name="ip">
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
    <p>IP4: <?= $result["ip4"] ?></p>
    <p>IP6: <?= $result["ip6"] ?></p>
    <p>HOST: <?= $result["hostname"] ?></p>
<?php endif; ?>

<h2>Ip Validator REST api</h2>
<p>För att validera ett ip med mitt REST api så gör du ett call till</p>
<p>POST: http://www.student.bth.se/~adei18/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipvalidateREST</p>
<p>Body ip="ip du vill validera"</p>


