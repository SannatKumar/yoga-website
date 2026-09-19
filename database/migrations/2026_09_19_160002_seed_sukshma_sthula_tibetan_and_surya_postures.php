<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Data-only migration: inserts new `asanas` rows (plus their
     * steps/benefits/contraindications) for Sukshma Vyayama, Sthula
     * Vyayama, and Tibetan Rites practices, all transcribed from
     * D:\Yoga_Asanas\Asanasdata\*.md — see docs/CONTENT_EXTRACTION_STATUS.md
     * and docs/UNIFIED_PRACTICE_SCHEMA.md.
     *
     * Also inserts 5 "Asana"-type rows for Surya Namaskara postures that
     * don't already exist in the table (Pranamasana, Hasta Uttanasana,
     * Ashwa Sanchalanasana, Parvatasana, Ashtanga Pranama) — needed so the
     * Surya Namaskara sequence (next migration) can reference every one of
     * its 12 steps by a real foreign key, not a free-text name. None of
     * these 5 have step/benefit/contraindication text in the source (only
     * breath/chakra/mantra, which lives on the sequence step itself).
     */
    public function up(): void
    {
        $practiceTypeId = [
            'sukshma_vyayama' => 2,
            'sthula_vyayama' => 3,
            'tibetan_rite' => 4,
            'asana' => 1,
        ];

        $practices = [
            // ---- Sukshma Vyayama (Shakti Vikasaka group) ----
            [
                'name' => 'Griva Shakti Vikasaka - Up and Down Movement',
                'description' => 'Neck Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand or sit comfortably on your mat with the head, neck, and spine aligned straight.',
                    'Inhale slowly and gently move the neck backward as far as comfortable. Do not strain.',
                    'Exhale and bring the neck forward so the chin moves toward the collarbone, if possible.',
                    'Repeat a few rounds and relax.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Griva Shakti Vikasaka - Twist Right and Left',
                'description' => 'Neck Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Remain in the same seated or standing position.',
                    'Exhale as you turn the chin toward the right shoulder.',
                    'Inhale while bringing the chin back to the center.',
                    'Keep the chin parallel to the floor throughout the movement.',
                    'Repeat on the left side.',
                    'Relax.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Griva Shakti Vikasaka - Tilt Right and Left',
                'description' => 'Neck Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Begin in the center position and inhale.',
                    'Exhale and tilt the neck to the right, bringing the right ear toward the right shoulder.',
                    'Do not lift the shoulder. Tilt only as much as comfortable.',
                    'Inhale back to the center position.',
                    'Exhale and tilt to the left side.',
                    'Repeat a few rounds and relax.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Griva Shakti Vikasaka - Half Neck Rotation',
                'description' => 'Neck Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Forward neck rotation: exhale and bend the head forward.',
                    'Gently rotate the neck side to side toward each shoulder, inhaling toward the shoulder and exhaling bringing the chin down.',
                    'Backward neck rotation: inhale and take the head backward.',
                    'Gently rotate the head side to side toward each shoulder, exhaling toward the shoulder and inhaling back to center.',
                    'Perform all movements slowly and carefully without jerks.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Bhuja Balli Shakti Vikasaka - Arm Raise',
                'description' => 'Arm Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand on your mat.',
                    'Inhale and raise the right arm sideways to shoulder level, palm facing out.',
                    'Exhale and bring the arm down.',
                    'Inhale and raise both arms upward, palms facing each other.',
                    'Exhale and bring the arms down beside the body.',
                    'Synchronize breath with movement.',
                    'Repeat and relax.',
                ],
                'benefits' => [
                    'Releases tension and strain in the neck, shoulders, and arms',
                ],
                'contraindications' => [
                    'People with frozen shoulders should practice gently, without effort or strain',
                ],
            ],
            [
                'name' => 'Purna Bhuja Shakti Vikasaka - Hand Rotation',
                'description' => 'Arm Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand on your mat with feet together.',
                    'Gently rotate each arm clockwise and anti-clockwise an equal number of times.',
                    'This can be done one arm at a time or both arms together.',
                    'Rotate gently without jerks.',
                    'Inhale as the arm moves upward.',
                    'Exhale as the arm moves downward.',
                    'Repeat a few rounds and relax.',
                ],
                'benefits' => [
                    'Releases tension and strain in the neck, shoulders, and arms',
                ],
                'contraindications' => [
                    'People with frozen shoulders should practice gently, without effort or strain',
                ],
            ],
            [
                'name' => 'Kati Shakti Vikasaka - Arch Bend',
                'description' => 'Waist Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand on your mat and interlock your fingers behind your back.',
                    'Inhale and bend backward, arching the spine.',
                    'Exhale and bend forward completely, letting the head relax.',
                    'Extend the interlocked arms as far as possible.',
                    'Slightly bend the knees if the back feels stiff.',
                    'Inhale and slowly come back to standing.',
                    'Take multiple breaths if needed. Do not hold the breath.',
                ],
                'benefits' => [
                    'Strengthens and improves flexibility of the back muscles',
                    'Improves spinal mobility',
                    'Stretches the hamstrings and gluteal muscles',
                    'Increases shoulder mobility',
                ],
                'contraindications' => [
                    'People with spinal issues, back pain, shoulder problems, blood pressure issues, vertigo, or heart conditions should skip or practice gently under expert guidance',
                ],
            ],
            [
                'name' => 'Kati Shakti Vikasaka - Arch Bend with Feet Apart',
                'description' => 'Waist Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet wide apart and place palms on the lower back.',
                    'Inhale and bend backward.',
                    'Exhale and bend forward slowly, keeping the spine straight.',
                    'Keep knees as straight as possible.',
                    'Do the movement slowly and carefully.',
                    'Do not hold the breath.',
                    'Inhale and return to the center.',
                ],
                'benefits' => [
                    'Strengthens and improves flexibility of the back muscles',
                    'Improves spinal mobility',
                    'Stretches the hamstrings and gluteal muscles',
                    'Increases shoulder mobility',
                ],
                'contraindications' => [
                    'People with spinal issues, back pain, shoulder problems, blood pressure issues, vertigo, or heart conditions should skip or practice gently under expert guidance',
                ],
            ],
            [
                'name' => 'Kati Shakti Vikasaka - Spring Bend',
                'description' => 'Waist Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet slightly apart and hands by the sides.',
                    'Inhale and bend backward.',
                    'Exhale and bend forward, keeping hands by the sides.',
                    'This is a dynamic movement.',
                    'Repeat and relax.',
                ],
                'benefits' => [
                    'Strengthens and improves flexibility of the back muscles',
                    'Improves spinal mobility',
                    'Stretches the hamstrings and gluteal muscles',
                    'Increases shoulder mobility',
                ],
                'contraindications' => [
                    'People with spinal issues, back pain, shoulder problems, blood pressure issues, vertigo, or heart conditions should skip or practice gently under expert guidance',
                ],
            ],
            [
                'name' => 'Kati Shakti Vikasaka - Side Bend',
                'description' => 'Waist Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet hip-width apart.',
                    'Raise both arms to shoulder level, parallel to the floor.',
                    'Slide to the right side, moving the right hand toward the right leg while the left arm moves upward.',
                    'Return to the center.',
                    'Repeat on the left side.',
                    'Keep the spine aligned and palms facing forward.',
                    'Exhale while bending sideways and inhale while returning.',
                    'Do not lean forward or backward.',
                    'Beginners may practice with wall support.',
                ],
                'benefits' => [
                    'Strengthens and improves flexibility of the back muscles',
                    'Improves spinal mobility',
                    'Stretches the hamstrings and gluteal muscles',
                    'Increases shoulder mobility',
                ],
                'contraindications' => [
                    'People with spinal issues, back pain, shoulder problems, blood pressure issues, vertigo, or heart conditions should skip or practice gently under expert guidance',
                ],
            ],
            [
                'name' => 'Kati Shakti Vikasaka - Spinal Twist',
                'description' => 'Waist Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet shoulder-width apart.',
                    'Raise both arms forward, parallel to the floor.',
                    'Inhale in the center.',
                    'Exhale and twist the spine by moving the arms sideways.',
                    'Alternate twisting left and right.',
                    'Keep arms parallel to the floor.',
                    'Repeat a few rounds and relax.',
                ],
                'benefits' => [
                    'Strengthens and improves flexibility of the back muscles',
                    'Improves spinal mobility',
                    'Stretches the hamstrings and gluteal muscles',
                    'Increases shoulder mobility',
                ],
                'contraindications' => [
                    'People with spinal issues, back pain, shoulder problems, blood pressure issues, vertigo, or heart conditions should skip or practice gently under expert guidance',
                ],
            ],
            [
                'name' => 'Jangha Shakti Vikasaka - Hip Opening',
                'description' => 'Hip Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet together.',
                    'Inhale and raise both arms forward, parallel to the floor.',
                    'Exhale and lower the hips as if sitting on a chair.',
                    'Keep knees aligned with toes.',
                    'Maintain an upright back.',
                    'Inhale and return to standing.',
                    'Repeat a few times.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Jangha Shakti Vikasaka II',
                'description' => 'Hip Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with heels together and toes apart.',
                    'Place hands on the waist or by the sides.',
                    'Inhale and rise onto the toes.',
                    'Exhale and squat down, spreading the knees sideways.',
                    'Lower the hips close to the heels without touching them.',
                    'Inhale and return to standing.',
                    'Repeat and relax.',
                ],
                'benefits' => [
                    'Strengthens thighs, knees, and core muscles',
                    'Opens the hips',
                ],
                'contraindications' => [
                    'Knee issues, ankle injuries, or dizziness',
                ],
            ],
            [
                'name' => 'Pada-Mula Shakti Vikasaka - Heels Up and Down',
                'description' => 'Ankle Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet hip-width apart.',
                    'Raise the heels and balance on the toes.',
                    'Hold for 10-15 seconds with normal breathing.',
                    'Lower the heels back to the mat.',
                    'Repeat a few times.',
                ],
                'benefits' => [
                    'Strengthens ankles and toes',
                    'Improves balance',
                    'Loosens the spine',
                ],
                'contraindications' => [
                    'Injuries to feet or ankles',
                ],
            ],
            [
                'name' => 'Pada-Mula Shakti Vikasaka - Toe Jumping',
                'description' => 'Ankle Practice',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand with feet hip-width apart.',
                    'Jump lightly on the toes a few times.',
                    'Relax.',
                ],
                'benefits' => [
                    'Strengthens ankles and toes',
                    'Improves balance',
                    'Loosens the spine',
                ],
                'contraindications' => [
                    'Injuries to feet or ankles',
                ],
            ],
            [
                'name' => 'Gulpha-Pada-Pristha-Pada-Tala Shakti Vikasaka',
                'description' => 'Ankle Rotation',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Stand or sit with legs stretched forward.',
                    'Keep the knee straight.',
                    'Gently rotate the ankle.',
                    'Maintain normal breathing.',
                    'Perform rotations clockwise and anti-clockwise.',
                    'Release and relax.',
                ],
                'benefits' => [
                    'Improves ankle mobility and flexibility',
                ],
                'contraindications' => [
                    'Acute ankle injury',
                ],
            ],

            // ---- Sukshma Vyayama (Pawanamuktasana series) ----
            [
                'name' => 'Ardha Titli Asana',
                'description' => 'Half Butterfly Pose',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Sit with both legs stretched forward.',
                    'Bend the left leg and place the left foot comfortably on the right thigh.',
                    'Place the left hand on top of the bent left knee.',
                    'Hold the toes of the left foot with the right hand.',
                    'Inhale and gently lift the left knee upward toward the chest.',
                    'Exhale and gently press the knee downward, attempting to touch the knee to the floor. Do not force the movement.',
                    'Perform 10 slow up-and-down movements.',
                    'Relax the leg muscles and, using the hand, gently move the knee up and down for a few counts without straining.',
                    'Repeat the full sequence on the right leg.',
                ],
                'benefits' => [
                    'Excellent preparatory practice for loosening the knee and hip joints',
                    'Prepares the body for meditative postures',
                ],
                'contraindications' => [
                    'Knee or hip injury or recent surgery',
                ],
            ],
            [
                'name' => 'Poorna Titli Asana',
                'description' => 'Full Butterfly Pose',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Sit with the legs stretched forward.',
                    'Bend both knees and bring the soles of the feet together.',
                    'Keep the heels as close to the perineum as comfortable.',
                    'Relax the inner thigh muscles.',
                    'Gently move both knees up and down, raising them slightly and lowering toward the floor without force. Repeat 10 times.',
                    'Place both hands on the knees and gently press them down toward the floor, allowing them to spring back up naturally. Repeat 10 times.',
                ],
                'benefits' => [
                    'Prepares the legs for mastery of Padmasana and other meditative asanas',
                    'Removes tiredness caused by long periods of standing and walking',
                ],
                'contraindications' => [
                    'Sciatica or sacral conditions',
                ],
            ],
            [
                'name' => 'Skanda Chakra',
                'description' => 'Shoulder Socket Rotation',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Place the fingers of both hands on their respective shoulders.',
                    'Rotate both elbows simultaneously in large circular movements.',
                    'On the forward movement, try to bring the elbows together in front of the chest.',
                    'While moving upward, attempt to touch the ears with the elbows.',
                    'On the backward movement, stretch the arms back.',
                    'While coming down, allow the elbows to touch the sides of the trunk.',
                    'Practice slowly: 10 rounds clockwise, then 10 rounds anticlockwise.',
                ],
                'benefits' => [
                    'Relieves strain caused by driving and prolonged office work',
                    'Helps reduce pressure in cervical spondylitis',
                    'Maintains the natural shape of the shoulders and chest',
                ],
                'contraindications' => [
                    'Frozen shoulders',
                    'Shoulder injury or recent shoulder surgery',
                ],
            ],
            [
                'name' => 'Padachakrasana',
                'description' => 'Leg Rotation',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Lie in the starting position and relax.',
                    'Raise the right leg approximately 45 degrees from the ground, keeping the knee straight.',
                    'Rotate the entire leg clockwise in a large, comfortable circle, ensuring the heel does not touch the floor.',
                    'Perform 10 clockwise rotations, then 10 anti-clockwise rotations.',
                    'Repeat with the left leg, clockwise then anti-clockwise, without straining.',
                    'Rest and practice abdominal breathing until respiration returns to normal.',
                    'Raise both legs together and rotate clockwise then anti-clockwise 3-5 times, keeping the legs together and straight throughout.',
                ],
                'benefits' => [
                    'Strengthens hip joints',
                    'Helps reduce obesity',
                    'Tones abdominal and spinal muscles',
                ],
                'contraindications' => [
                    'High blood pressure',
                    'Serious back conditions such as sciatica or slipped disc',
                ],
            ],
            [
                'name' => 'Supta Pawanmuktasana',
                'description' => 'Leg Lock Pose',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Lie in the starting position and relax.',
                    'Bend the right knee and bring the thigh to the chest.',
                    'Interlock the fingers and clasp the hands on the knee or shin just below the right knee.',
                    'Keep the left leg straight on the ground.',
                    'Inhale deeply, filling the lungs.',
                    'Exhale and raise the head and shoulders off the ground, gently bringing the right knee toward the nose.',
                    'Hold the final position for a few seconds without straining.',
                    'Slowly inhale and return to the base position. Relax the body.',
                    'Repeat 3 times with the right leg, then 3 times with the left leg.',
                    'Bend both knees to the chest, clasp the shins, inhale deeply, then exhale and raise the head and shoulders, attempting to place the nose between the knees.',
                    'Hold briefly, then slowly lower while inhaling. Repeat 3 times.',
                ],
                'benefits' => [
                    'Strengthens the lower back muscles',
                    'Loosens the spinal vertebrae',
                    'Massages the abdomen and digestive organs',
                    'Effective in relieving wind and constipation',
                ],
                'contraindications' => [
                    'High blood pressure',
                    'Serious back conditions such as sciatica or slipped disc',
                ],
            ],
            [
                'name' => 'Supta Udarakarshanasana',
                'description' => 'Sleeping Abdominal Stretch Pose',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Lie in the starting position and relax.',
                    'Bend the knees and place the soles of both feet flat on the floor, directly in front of the buttocks, knees and feet together.',
                    'Interlock the fingers of both hands, place the palms under the back of the head, and let the elbows touch the floor.',
                    'Inhale, and while exhaling, slowly lower the legs to the right, attempting to bring the knees toward the floor.',
                    'Keep the feet together, though the left foot may lift slightly off the floor.',
                    'Simultaneously, gently turn the head and neck in the opposite direction to the legs for a uniform twisting stretch of the spine.',
                    'Inhale and raise the legs back to the upright position, keeping the shoulders and elbows on the floor throughout.',
                    'Repeat on the left side to complete one round. Perform 5 complete rounds.',
                ],
                'benefits' => [
                    'Provides an excellent stretch to abdominal muscles and organs',
                    'Improves digestion and relieves constipation',
                    'Twisting stretch of the spine relieves strain and stiffness caused by prolonged sitting',
                ],
                'contraindications' => [
                    'Back or neck pain',
                    'Injury to the spine or neck',
                ],
            ],
            [
                'name' => 'Gatyatmak Meru Vakrasana',
                'description' => 'Dynamic Spinal Twist',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Sit on the floor with both legs outstretched.',
                    'Separate the legs as far apart as comfortably possible. Keep the knees straight.',
                    'Stretch the arms sideways at shoulder level.',
                    'Exhale and twist to the left: bring the right hand down toward the left big toe, stretch the straight left arm behind the back as the trunk twists left, keep both arms in one straight line, turn the head to the left and gaze at the left outstretched hand.',
                    'Inhale and return to center, keeping the arms stretched sideways at shoulder level.',
                    'Exhale and twist to the opposite side: bring the left hand down toward the right big toe, stretch the straight right arm behind the back, turn the head to the right and gaze at the right outstretched hand.',
                    'This completes one round. Repeat for 10 rounds.',
                ],
                'benefits' => [
                    'Removes stiffness in the back',
                    'Increases flexibility of the spine',
                ],
                'contraindications' => [
                    'Back conditions',
                ],
            ],
            [
                'name' => 'Kashtha Takshanasana',
                'description' => 'Chopping Wood Pose',
                'type' => 'sukshma_vyayama',
                'steps' => [
                    'Squat with the feet flat on the floor, angled about 45 degrees apart.',
                    'Fully bend the knees and separate them comfortably.',
                    'Clasp the fingers of both hands together and place them just above the floor between the feet.',
                    'Straighten the arms and keep them straight throughout the practice.',
                    'Ensure the elbows stay inside the knees. Keep the eyes open.',
                    'Raise the arms above and behind the head, stretching the spine upward, and look up toward the hands.',
                    'Make a downward stroke with the arms, as if chopping wood, exhaling with a "Ha" sound, and return the hands near the floor between the feet.',
                    'This completes one round. Practice 5-10 rounds.',
                ],
                'benefits' => [
                    'Loosens the pelvic girdle and tones pelvic muscles',
                    'Strengthens back muscles between shoulder blades',
                    'Improves shoulder joints and upper back muscles',
                    'Helps release frustration and lighten mood',
                ],
                'contraindications' => [
                    'Heart conditions or frozen shoulders',
                    'Use variations if suffering from knee problems, sciatica, or similar issues',
                ],
            ],

            // ---- Sthula Vyayama ----
            [
                'name' => 'Sarvanga Pushti',
                'description' => null,
                'type' => 'sthula_vyayama',
                'steps' => [
                    'Stand with legs stretched apart as much as possible.',
                    'Make a fist with both palms, keeping the thumbs tucked in.',
                    'Place the left fist on top of the right fist.',
                    'Inhale and raise the arms upward behind the head.',
                    'Exhale and bend toward the right ankle in a circular motion, keeping the elbows straight.',
                    'Swap the position of the fists.',
                    'Inhale and raise the arms upward behind the head again.',
                    'Exhale and bend toward the left ankle in a circular motion, keeping the elbows straight.',
                    'Swap the wrists once more. Inhale and return to the starting position.',
                    'This completes one round. Repeat for 5-7 rounds.',
                ],
                'benefits' => [
                    'Makes the body supple and strong',
                    'Improves flexibility of the spine',
                    'Helps cure stiffness in the back',
                    'Reduces fat around the waist',
                ],
                'contraindications' => [
                    'Severe back pain',
                    'Vertigo',
                    'Cervical spondylitis',
                    'Heart conditions',
                    'Hernia',
                    'Recent surgery',
                ],
            ],
            [
                'name' => 'Hrid Gati',
                'description' => 'Engine Daud',
                'type' => 'sthula_vyayama',
                'steps' => [
                    'Stand with legs straight and feet together.',
                    'Make fists with both palms, keeping the thumbs tucked in.',
                    'Bend the left arm at a 90-degree angle and bend the left leg backward at a 90-degree angle.',
                    'Stretch the right arm straight forward, parallel to the floor, while the right leg remains straight.',
                    'Alternate the arm and leg positions, moving the left arm forward and straightening the left leg while simultaneously bending the right arm and right leg.',
                    'Continue the movement in a smooth, continuous manner, alternating between right and left.',
                    'Keep elbows from moving behind the body when bent, bring the heel close to the buttocks when the knee is bent, and thrust the arm firmly forward when stretched.',
                    'Practice for 15-30 seconds initially, increasing duration gradually with practice.',
                    'Pause and relax after completing the practice.',
                ],
                'benefits' => [
                    'Revitalizes the entire body',
                    'Expands the chest',
                    'Provides a good workout for the calves and thigh muscles',
                ],
                'contraindications' => [
                    'Severe knee issues',
                    'Heart conditions',
                    'Hernia',
                    'Recent surgery',
                    'Back problems',
                    'Frozen shoulders',
                ],
            ],

            // ---- Tibetan Rites ----
            [
                'name' => 'Tibetan Rite 1',
                'description' => null,
                'type' => 'tibetan_rite',
                'steps' => [
                    'Stand erect with arms outstretched horizontally, palms facing down, in line with the shoulders.',
                    'Spin clockwise until slightly dizzy.',
                    'Gradually increase the number of spins from 1 spin up to 21 spins.',
                    'After spinning, keep the right leg forward, join the palms, and look at the tips of your fingers while waiting for the dizziness to subside.',
                    'Inhale and exhale normally during the spins.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Tibetan Rite 2',
                'description' => null,
                'type' => 'tibetan_rite',
                'steps' => [
                    'Lie flat on the floor, face up.',
                    'Fully extend your arms along the sides of the body, palms on the floor, fingers together.',
                    'Raise the head, tucking the chin into the chest.',
                    'Lift the legs straight into a vertical position, extending them over the body toward the head if possible, keeping the knees straight throughout.',
                    'Slowly lower the head and legs back to the floor.',
                    'Allow the muscles to relax and repeat the sequence.',
                    'Inhale deeply while lifting the head and legs; exhale while lowering them.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Tibetan Rite 3',
                'description' => null,
                'type' => 'tibetan_rite',
                'steps' => [
                    'Kneel on the floor with the body erect.',
                    'Place the hands on the backs of your thighs or support the lower back.',
                    'Incline the head and neck forward, tucking the chin against the chest.',
                    'Throw the head and neck backward, arching the spine.',
                    'Curl the toes under for support, bracing the arms and hands against the thighs while arching.',
                    'Return to the erect position and repeat the rite.',
                    'Inhale while arching the spine; exhale while returning to the erect position.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Tibetan Rite 4',
                'description' => null,
                'type' => 'tibetan_rite',
                'steps' => [
                    'Sit on the floor with legs straight in front of you, feet about 12 inches apart.',
                    'Keep the trunk erect. Place the palms on the floor alongside your buttocks.',
                    'Tuck the chin forward against the chest.',
                    'Drop the head backward as far as comfortable.',
                    'Simultaneously raise the body so that the knees bend, keeping the arms straight, and tense every muscle in the body.',
                    'Relax the muscles as you return to the original sitting position.',
                    'Inhale as you rise up; exhale fully as you return to the sitting position.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Tibetan Rite 5',
                'description' => null,
                'type' => 'tibetan_rite',
                'steps' => [
                    'Assume the Mountain Pose with heels on the floor or lifted, ears aligned with the arms.',
                    'Tuck the chin into the collarbone.',
                    'Bring the hips down while keeping the arms straight.',
                    'Once the hips are lowered, lift the chin and try to look at the ceiling.',
                    'Keep the knees and thighs off the floor throughout the practice.',
                    'Inhale while lowering the hips; exhale while lifting the hips back into the Mountain Pose.',
                ],
                'benefits' => [],
                'contraindications' => [],
            ],

            // ---- Surya Namaskara postures not already in `asanas` ----
            // No per-posture body instructions exist in the source (surya-namaskara.md
            // only gives breath/chakra/mantra, which belongs on the sequence step, not
            // the posture itself) — inserted with empty steps/benefits/contraindications.
            [
                'name' => 'Pranamasana',
                'description' => 'Prayer Pose / Salutation Pose',
                'type' => 'asana',
                'steps' => [],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Hasta Uttanasana',
                'description' => 'Raised Arms Pose / Hands Upward Stretch Pose',
                'type' => 'asana',
                'steps' => [],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Ashwa Sanchalanasana',
                'description' => 'Equestrian Pose / Low Lunge',
                'type' => 'asana',
                'steps' => [],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Parvatasana',
                'description' => 'Mountain Pose / Downward Facing Pose',
                'type' => 'asana',
                'steps' => [],
                'benefits' => [],
                'contraindications' => [],
            ],
            [
                'name' => 'Ashtanga Pranama',
                'description' => 'Eight-Limbed Salutation',
                'type' => 'asana',
                'steps' => [],
                'benefits' => [],
                'contraindications' => [],
            ],
        ];

        foreach ($practices as $practice) {
            $asanaId = DB::table('asanas')->insertGetId([
                'practice_type_id' => $practiceTypeId[$practice['type']],
                'asana_name' => $practice['name'],
                'asana_description' => $practice['description'],
                'deleted' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($practice['steps'] as $index => $step) {
                DB::table('asana_steps')->insert([
                    'asanas_id' => $asanaId,
                    'asana_steps' => $step,
                    'steps_order_number' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($practice['benefits'] as $index => $benefit) {
                DB::table('asana_benefits')->insert([
                    'asanas_id' => $asanaId,
                    'benefit' => $benefit,
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($practice['contraindications'] as $index => $contraindication) {
                DB::table('asana_contraindications')->insert([
                    'asanas_id' => $asanaId,
                    'contraindication' => $contraindication,
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $names = [
            'Griva Shakti Vikasaka - Up and Down Movement', 'Griva Shakti Vikasaka - Twist Right and Left',
            'Griva Shakti Vikasaka - Tilt Right and Left', 'Griva Shakti Vikasaka - Half Neck Rotation',
            'Bhuja Balli Shakti Vikasaka - Arm Raise', 'Purna Bhuja Shakti Vikasaka - Hand Rotation',
            'Kati Shakti Vikasaka - Arch Bend', 'Kati Shakti Vikasaka - Arch Bend with Feet Apart',
            'Kati Shakti Vikasaka - Spring Bend', 'Kati Shakti Vikasaka - Side Bend', 'Kati Shakti Vikasaka - Spinal Twist',
            'Jangha Shakti Vikasaka - Hip Opening', 'Jangha Shakti Vikasaka II',
            'Pada-Mula Shakti Vikasaka - Heels Up and Down', 'Pada-Mula Shakti Vikasaka - Toe Jumping',
            'Gulpha-Pada-Pristha-Pada-Tala Shakti Vikasaka',
            'Ardha Titli Asana', 'Poorna Titli Asana', 'Skanda Chakra', 'Padachakrasana',
            'Supta Pawanmuktasana', 'Supta Udarakarshanasana', 'Gatyatmak Meru Vakrasana', 'Kashtha Takshanasana',
            'Sarvanga Pushti', 'Hrid Gati',
            'Tibetan Rite 1', 'Tibetan Rite 2', 'Tibetan Rite 3', 'Tibetan Rite 4', 'Tibetan Rite 5',
            'Pranamasana', 'Hasta Uttanasana', 'Ashwa Sanchalanasana', 'Parvatasana', 'Ashtanga Pranama',
        ];

        $ids = DB::table('asanas')->whereIn('asana_name', $names)->pluck('id');

        DB::table('asana_steps')->whereIn('asanas_id', $ids)->delete();
        DB::table('asana_benefits')->whereIn('asanas_id', $ids)->delete();
        DB::table('asana_contraindications')->whereIn('asanas_id', $ids)->delete();
        DB::table('asanas')->whereIn('id', $ids)->delete();
    }
};
