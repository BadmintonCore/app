<?php

namespace Vestis\Controller;

class CustomerServiceController
{
    public function contact(): void
    {
        require_once "../views/customer-service/contact.php";
    }

    public function faq(): void
    {
        require_once "../views/customer-service/faq.php";
    }

    public function returns(): void
    {
        require_once "../views/customer-service/returns.php";
    }
}
