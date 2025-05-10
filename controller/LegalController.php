<?php

namespace Vestis\Controller;

class LegalController
{
    public function gtc(): void
    {
        require_once __DIR__."/../views/legal/gtc.php";
    }

    public function impress(): void
    {
        require_once __DIR__."/../views/legal/impress.php";
    }

    public function privacy(): void
    {
        require_once __DIR__."/../views/legal/privacypolicy.php";
    }

    public function revocation(): void
    {
        require_once __DIR__."/../views/legal/revocation.php";
    }
}
