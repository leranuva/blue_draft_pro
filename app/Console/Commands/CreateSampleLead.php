<?php

namespace App\Console\Commands;

use App\Jobs\AddLeadToEmailSequence;
use App\Models\Quote;
use Illuminate\Console\Command;

class CreateSampleLead extends Command
{
    protected $signature = 'leads:create-sample
                            {--complete : Crear lead completo (Step 2) en lugar de parcial}
                            {--dispatch : Despachar AddLeadToEmailSequence (envía emails de secuencia)}
                            {--email= : Email personalizado (default: sample-lead-{random}@example.com)}';

    protected $description = 'Crea un lead de prueba para observar el comportamiento del sistema';

    public function handle(): int
    {
        $email = $this->option('email') ?? 'sample-lead-' . substr(uniqid(), -6) . '@example.com';

        $quote = Quote::create([
            'client_name' => 'María García (Lead de prueba)',
            'email' => $email,
            'phone' => $this->option('complete') ? '+1 555 123 4567' : null,
            'address' => $this->option('complete') ? '123 Broadway, Manhattan, NY 10012' : null,
            'borough' => $this->option('complete') ? 'manhattan' : null,
            'service_type' => 'renovation',
            'estimated_budget' => $this->option('complete') ? '50k-100k' : null,
            'message' => $this->option('complete') ? 'Interesada en remodelar la cocina. Zona Manhattan.' : null,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
            'is_partial' => !$this->option('complete'),
            'step' => $this->option('complete') ? 2 : 1,
            'lead_score' => 3,
            'lead_source' => 'sample_command',
            'utm_source' => 'testing',
            'utm_medium' => 'manual',
            'utm_campaign' => 'sample_lead',
            'source_url' => 'https://bluedraft.cc/',
        ]);

        if ($this->option('dispatch')) {
            AddLeadToEmailSequence::dispatch($quote);
            $this->info("Job AddLeadToEmailSequence despachado para quote #{$quote->id}");
        }

        $type = $this->option('complete') ? 'completo (Step 2)' : 'parcial (Step 1)';
        $this->info("Lead de prueba creado: Quote #{$quote->id} ({$type})");
        $this->table(
            ['Campo', 'Valor'],
            [
                ['ID', $quote->id],
                ['Nombre', $quote->client_name],
                ['Email', $quote->email],
                ['Servicio', $quote->service_type],
                ['Parcial', $quote->is_partial ? 'Sí' : 'No'],
                ['Lead Score', $quote->lead_score],
            ]
        );

        $this->newLine();
        $this->info('Ver en el panel: ' . config('app.url') . '/system-bd-access/quotes/' . $quote->id . '/edit');
        $this->comment('Para procesar la cola de emails: php artisan queue:work');

        return self::SUCCESS;
    }
}
