
<?php
    require_once "./controller/dashboard.php";
    


    require_once "./controller/authenticate.php";
    require_once "./controller/consultation.php";
    require_once "./controller/courses.php";
    require_once "./controller/kits.php";
    require_once "./controller/discounts.php";
    // require_once "./controller/hours.php";
    require_once "./controller/home.php";
    require_once "./controller/invoices.php";
    require_once "./controller/modules.php";
    require_once "./controller/orders.php";
    require_once "./controller/permissions.php";
    require_once "./controller/permissions_roles.php";
    require_once "./controller/pos.php";
    // require_once "./controller/prices.php";
    // require_once "./controller/quotas.php";
    require_once "./controller/roles.php";
    require_once "./controller/spy.php";
    require_once "./controller/scenarios.php";
    require_once "./controller/sports.php";
    require_once "./controller/status.php";
    require_once "./controller/users.php";
    
    
    require_once "./model/authenticate.php";
    require_once "./model/consultation.php";
    require_once "./model/courses.php";
    require_once "./model/kits.php";
    require_once "./model/home.php";
    require_once "./model/invoices.php";
    require_once "./model/discounts.php";
    // require_once "./model/hours.php";
    require_once "./model/modules.php";
    require_once "./model/orders.php";
    require_once "./model/permissions.php";
    require_once "./model/permissions_roles.php";
    require_once "./model/pos.php";
    require_once "./model/spy.php";
    // require_once "./model/prices.php";
    // require_once "./model/quotas.php";
    require_once "./model/roles.php";
    require_once "./model/scenarios.php";
    require_once "./model/sports.php";
    require_once "./model/status.php";
    require_once "./model/users.php";

    require_once "./model/users.php";

    
    require_once "./controller/dashboard.php";
    require_once "./fpdf/fpdf.php";


    
    $template = new ControllerDashboard();
    $template->CtrDashboard(); // Llamar al método CtrDashboard()

    // $template = new ControllerDashboard();
    // $template->CtrDashboard(); // Llamar al método CtrDashboard()

?> 