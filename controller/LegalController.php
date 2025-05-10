<?php

namespace Vestis\Controller;

class LegalController
{

    public function gtc(): void
    {
        require_once "../views/legal/gtc.php";
    }

    public function impress(): void
    {
        require_once "../views/legal/impress.php";
    }

    public function privacy(): void
    {
        require_once "../views/legal/privacypolicy.php";
    }

    public function revocation(): void
    {
        require_once "../views/legal/revocation.php";
    }
}

