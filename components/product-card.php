<?php


function generateProjectCard(string $imgLocation, string $detailPath, string $name, float $price): string
{
    return <<<EOT
        <div class="card">
                <img
                        src="$imgLocation"
                        alt="product image"/>
                <br>
                <h2><a href="$detailPath">$name</a></h2>
                <h4>$price €</h4>
                <a href="itemid.php" class="btn btn-sm">details.</a>
            </div>
        EOT;
}