<?php

return [

    /*
    | Horas que una venta puede quedar en "pending" (reservando stock) antes de
    | que `sales:release-expired` la elimine y devuelva el stock. 0 = nunca.
    */
    'pending_ttl_hours' => (int) env('SALES_PENDING_TTL_HOURS', 48),

];
