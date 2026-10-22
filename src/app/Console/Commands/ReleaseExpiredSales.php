<?php

namespace App\Console\Commands;

use App\Models\Sales;
use Illuminate\Console\Command;

class ReleaseExpiredSales extends Command
{
    protected $signature = 'sales:release-expired {--hours= : Antigüedad mínima en horas (por defecto config sales.pending_ttl_hours)}';

    protected $description = 'Elimina ventas pendientes sin pago aprobado y devuelve su stock';

    public function handle(): int
    {
        $hours = (int) ($this->option('hours') ?? config('sales.pending_ttl_hours'));

        if ($hours < 1) {
            $this->info('Liberación de ventas pendientes deshabilitada.');

            return self::SUCCESS;
        }

        $cutoff = now()->subHours($hours);
        $released = 0;

        Sales::where('status', 'pending')
            ->where('created_at', '<', $cutoff)
            ->whereDoesntHave('payments', function ($query) use ($cutoff) {
                $query->where('payment_status', 'approved')
                    ->orWhere('updated_at', '>=', $cutoff);
            })
            ->each(function (Sales $sale) use (&$released) {
                $sale->deleteAndRestoreStock();
                $released++;
            });

        $this->info("Ventas liberadas: {$released}");

        return self::SUCCESS;
    }
}
