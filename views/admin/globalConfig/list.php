<?php

use Vestis\Database\Dto\PaginationDto;
use Vestis\Database\Models\GlobalConfig;
use Vestis\Utility\PaginationUtility;

/** @var PaginationDto<GlobalConfig> $configs */
/** @var int $page */

?>

<!--Author: Lennart Moog-->
<!DOCTYPE html>
<html lang="de">
<head>
    <title>vestis. - Konfigurationen</title>
    <?php include(__DIR__ . "/../../../components/head.php"); ?>
</head>
<body>
<!--Inhalt der Seite-->

<?php include(__DIR__ . "/../../../components/adminHeader.php"); ?>

<main>

    <!--Breadcrumbs-->
    <?php include(__DIR__ . "/../../../components/breadcrumbs.php"); ?>

    <h1>Konfigurationen</h1>

    <table class="mt-4">
        <thead>
        <tr>
            <th>Schlüssel</th>
            <th>Wert</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($configs->results as $config): ?>
            <tr>
                <td><?= $config->attribute ?></td>
                <td>
                    <div class="max-content">
                        <?= trim($config->value) ?>
                    </div>
                </td>
                <td>
                    <a class="btn btn-sm" href="/admin/globalConfigs/edit?attribute=<?= $config->attribute ?>">Bearbeiten.</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php PaginationUtility::generatePagination($configs->count, 10, $page); ?>

</main>

<!--Footer der Website-->
<?php include(__DIR__ . "/../../../components/adminFooter.php"); ?>
<?php include(__DIR__ . "/../../../components/scripts.php"); ?>
</body>
</html>
<!--Author: Lennart Moog -->

