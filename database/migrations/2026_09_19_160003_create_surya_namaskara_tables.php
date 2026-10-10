<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Surya Namaskara is a *sequence* of 12 postures, not a single practice
     * with its own steps — several of its postures are (or now are) their
     * own rows in `asanas` (Pranamasana, Hasta Uttanasana, Pada Hastasana,
     * Ashwa Sanchalanasana, Parvatasana, Ashtanga Pranama, Bhujangasana),
     * each repeated at different points in the sequence with a different
     * mantra/chakra. So it gets its own small schema instead of being
     * forced into the `asanas` shape:
     *
     *   surya_namaskara               - one header row (title/introduction)
     *   surya_namaskara_benefits      - one-to-many, same shape as asana_benefits
     *   surya_namaskara_contraindications - one-to-many, same shape as asana_contraindications
     *   surya_namaskara_steps         - the 12 ordered steps, each FK'd to
     *                                    the underlying asanas row, plus the
     *                                    step-specific breath/chakra/mantra
     */
    public function up(): void
    {
        Schema::create('surya_namaskara', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('introduction')->nullable();
            $table->timestamps();
        });

        Schema::create('surya_namaskara_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surya_namaskara_id')->constrained('surya_namaskara')->cascadeOnDelete();
            $table->string('benefit', 500);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        Schema::create('surya_namaskara_contraindications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surya_namaskara_id')->constrained('surya_namaskara')->cascadeOnDelete();
            $table->string('contraindication', 500);
            $table->integer('sort_order')->nullable();
            $table->timestamps();
        });

        Schema::create('surya_namaskara_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surya_namaskara_id')->constrained('surya_namaskara')->cascadeOnDelete();
            $table->foreignId('asanas_id')->constrained('asanas');
            $table->integer('step_order');
            $table->string('breathing', 50)->nullable();
            $table->string('chakra', 100)->nullable();
            $table->string('mantra', 150)->nullable();
            $table->timestamps();

            $table->unique(['surya_namaskara_id', 'step_order']);
        });

        $suryaNamaskaraId = DB::table('surya_namaskara')->insertGetId([
            'title' => 'Surya Namaskara',
            'introduction' => "Surya Namaskara, or the Sun Salutation, is traditionally practiced in the early morning or evening, facing the Sun. The Sun is revered as a deity, symbolizing health, vitality, and the life-giving force that sustains the universe. It combines yoga asanas and breathing practices, preparing the body for advanced yogic postures and pranayama by increasing flexibility in the spine and muscles, reducing visceral fat, and enhancing lung function and correct breathing. The series consists of 12 postures, each stretching different ligaments and mobilizing the vertebral column: forward bending contracts the abdomen and diaphragm to aid exhalation, backward bending expands the chest to allow deep inhalation, and exposure to the Sun's rays invigorates the body and helps remove toxins through perspiration.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('surya_namaskara_benefits')->insert([
            ['surya_namaskara_id' => $suryaNamaskaraId, 'benefit' => 'Increases flexibility in the spine and muscles', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'benefit' => 'Reduces visceral fat', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'benefit' => 'Enhances lung function and correct breathing', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'benefit' => 'Improves circulation and harmonizes breath with movement', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('surya_namaskara_contraindications')->insert([
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'Acute high blood pressure', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'Hernia', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'Heart disease', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'History of stroke', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'Back problems (consult a yoga expert before practice)', 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['surya_namaskara_id' => $suryaNamaskaraId, 'contraindication' => 'Fever, inflammation, or menstruation', 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $asanaId = function (string $name) {
            $id = DB::table('asanas')->where('asana_name', $name)->value('id');

            if (! $id) {
                throw new \RuntimeException("Surya Namaskara seed: asana '{$name}' not found — run the posture-seeding migration first.");
            }

            return $id;
        };

        $steps = [
            ['posture' => 'Pranamasana', 'breathing' => 'Exhale', 'chakra' => 'Ajna Chakra', 'mantra' => 'Om Mitraya Namaha'],
            ['posture' => 'Hasta Uttanasana', 'breathing' => 'Inhale', 'chakra' => 'Vishuddhi', 'mantra' => 'Om Ravaye Namaha'],
            ['posture' => 'Padahastasana', 'breathing' => 'Exhale', 'chakra' => 'Manipura', 'mantra' => 'Om Suryaya Namaha'],
            ['posture' => 'Ashwa Sanchalanasana', 'breathing' => 'Inhale', 'chakra' => 'Swadhisthana', 'mantra' => 'Om Bhaanave Namaha'],
            ['posture' => 'Parvatasana', 'breathing' => 'Exhale', 'chakra' => 'Sahasrara', 'mantra' => 'Om Khagaya Namaha'],
            ['posture' => 'Ashtanga Pranama', 'breathing' => 'Inhale and Exhale', 'chakra' => 'Anahata', 'mantra' => 'Om Pushne Namaha'],
            ['posture' => 'Bhujanga Asana', 'breathing' => 'Inhale', 'chakra' => 'Mooladhara', 'mantra' => 'Om Hiranyagarbhaya Namaha'],
            ['posture' => 'Parvatasana', 'breathing' => 'Exhale', 'chakra' => 'Sahasrara', 'mantra' => 'Om Marichaye Namaha'],
            ['posture' => 'Ashwa Sanchalanasana', 'breathing' => 'Inhale', 'chakra' => 'Swadhisthana', 'mantra' => 'Om Aadityaaya Namaha'],
            ['posture' => 'Padahastasana', 'breathing' => 'Exhale', 'chakra' => 'Manipura', 'mantra' => 'Om Savitre Namaha'],
            ['posture' => 'Hasta Uttanasana', 'breathing' => 'Inhale', 'chakra' => 'Vishuddhi', 'mantra' => 'Om Arkaaya Namaha'],
            ['posture' => 'Pranamasana', 'breathing' => 'Exhale, then normal breathing', 'chakra' => null, 'mantra' => null],
        ];

        foreach ($steps as $index => $step) {
            DB::table('surya_namaskara_steps')->insert([
                'surya_namaskara_id' => $suryaNamaskaraId,
                'asanas_id' => $asanaId($step['posture']),
                'step_order' => $index + 1,
                'breathing' => $step['breathing'],
                'chakra' => $step['chakra'],
                'mantra' => $step['mantra'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surya_namaskara_steps');
        Schema::dropIfExists('surya_namaskara_contraindications');
        Schema::dropIfExists('surya_namaskara_benefits');
        Schema::dropIfExists('surya_namaskara');
    }
};
