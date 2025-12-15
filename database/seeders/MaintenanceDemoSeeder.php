<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\MaintenanceOrder;
use App\Models\MaintenanceLog;

class MaintenanceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $machines = [
            [
                'naam' => 'Koffiezetter Pro 3000',
                'type' => 'Koffieautomaat',
                'serienummer' => 'KOF-3000-001',
                'status' => 'operationeel',
                'specificaties' => 'Vermogen: 1500W; Waterreservoir: 2L; Bouwjaar: 2022',
            ],
            [
                'naam' => 'EspressoMaster X2',
                'type' => 'Espressomachine',
                'serienummer' => 'ESP-X2-002',
                'status' => 'storing',
                'specificaties' => 'Druk: 15 bar; Waterfilter: Ja; Bouwjaar: 2021',
            ],
            [
                'naam' => 'BeanGrinder 500',
                'type' => 'Koffiemolen',
                'serienummer' => 'GRD-500-003',
                'status' => 'gepland_onderhoud',
                'specificaties' => 'Capaciteit: 500g; Maalgraad: instelbaar; Bouwjaar: 2020',
            ],
            [
                'naam' => 'Melkopschuimer Deluxe',
                'type' => 'Melkopschuimer',
                'serienummer' => 'MLK-DLX-004',
                'status' => 'operationeel',
                'specificaties' => 'Inhoud: 0.5L; Automatisch: Ja; Bouwjaar: 2023',
            ],
            [
                'naam' => 'FilterKing 200',
                'type' => 'Filtermachine',
                'serienummer' => 'FLT-200-005',
                'status' => 'operationeel',
                'specificaties' => 'Filtertype: Papier; Timer: Ja; Bouwjaar: 2019',
            ],
        ];

        foreach ($machines as $data) {
            $machine = Machine::create($data);

            // Orders per machine
            for ($i = 1; $i <= rand(1,3); $i++) {
                $order = MaintenanceOrder::create([
                    'machine_id' => $machine->id,
                    'titel' => 'Onderhoudsbeurt ' . $i,
                    'beschrijving' => 'Routine inspectie en reiniging van machine.',
                    'status' => ['ingepland','bezig','afgerond'][array_rand(['ingepland','bezig','afgerond'])],
                    'gepland_op' => now()->addDays(rand(-30,30)),
                    'uitgevoerd_op' => rand(0,1) ? now()->addDays(rand(-30,0)) : null,
                ]);

                // Logboekregels per order
                for ($j = 1; $j <= rand(1,2); $j++) {
                    MaintenanceLog::create([
                        'machine_id' => $machine->id,
                        'maintenance_order_id' => $order->id,
                        'gebruiker' => ['Jan Technicus','Sanne Monteur','Piet Service'][array_rand(['Jan Technicus','Sanne Monteur','Piet Service'])],
                        'omschrijving' => 'Controle uitgevoerd, alles in orde. Opmerking: ' . ['Geen bijzonderheden','Kleine lekkage verholpen','Filter vervangen'][array_rand(['Geen bijzonderheden','Kleine lekkage verholpen','Filter vervangen'])],
                        'toegevoegd_op' => now()->addMinutes(rand(-10000,0)),
                    ]);
                }
            }
        }
    }
}
