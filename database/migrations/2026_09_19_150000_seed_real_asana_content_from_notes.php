<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Data-only migration (no schema change): populates asana_steps,
     * asana_benefits, and asana_contraindications for the 29 asanas
     * (of 40 in the `asanas` table) whose real content already exists,
     * transcribed from D:\Yoga_Asanas\Asanasdata\*.md — see
     * docs/CONTENT_EXTRACTION_STATUS.md for the full source mapping.
     *
     * Only inserts for asanas_id values that have no existing rows in
     * these three tables (verified before writing this migration), so
     * it does not touch Tadasana (1) or Padahastasana (2), which already
     * have their own real data.
     */
    public function up(): void
    {
        $content = [
            5 => [ // Trikonasana
                'steps' => [
                    'Stand erect with the feet apart, about 4-5 ft, adjusting for height and balance.',
                    'Turn the right foot to the right side.',
                    'Stretch the arms sideways and raise them to shoulder level, keeping them in one straight line.',
                    'Turn the chin to the right and bend to the right with exhalation, taking care not to bring the body forward.',
                    'If necessary, bend the knees, but try to keep them straight and pull the kneecaps up.',
                    'Keep the arms in line, palms facing forward. Look up at the left hand in the final position.',
                    'To come out: turn the chin down, inhale, rise up, turn the chin forward, bring hands down, and return to the starting position.',
                    'Repeat on the opposite side.',
                ],
                'benefits' => [
                    'Affects muscles on the sides of the trunk, waist, and back of the legs',
                    'Improves digestion',
                    'Strengthens the pelvic area and tones reproductive organs',
                    'Helps reduce waistline fat',
                ],
                'contraindications' => [
                    'Back conditions',
                    'Knee injuries',
                    'Frozen shoulder issues',
                    'Vertigo',
                    'High blood pressure',
                ],
            ],
            6 => [ // Vrikshasana
                'steps' => [
                    'Stand straight with arms by the side of the body. Focus on a point in front of you.',
                    'Bend the right knee and place the right foot high on the left thigh, with the sole flat and firm near the root of the thigh.',
                    'Ensure the left leg is straight and find your balance.',
                    'Once balanced, take a deep breath in and bring the palms together in Namaskara Mudra at the chest.',
                    'Slowly raise the hands overhead, keeping palms together.',
                    'Keep a steady gaze at a distant point to maintain balance.',
                    'With slow exhalation, gently reverse the steps and release the right leg.',
                    'Stand tall and repeat the pose with the left leg raised on the right thigh.',
                ],
                'benefits' => [
                    'Brings balance and equilibrium to the mind',
                    'Improves concentration',
                    'Strengthens the legs and opens the hips',
                    'Relieves some cases of sciatica',
                ],
                'contraindications' => [
                    'Migraine',
                    'Insomnia',
                    'Low or high blood pressure (high BP practitioners may skip raising hands overhead)',
                ],
            ],
            7 => [ // Dandasana
                'steps' => [
                    'Begin in a seated position with legs extended forward.',
                    'Place your hands next to your hips, straighten the arms, and place your palms on the floor.',
                    'Flex your ankles with toes tucked in.',
                    'Roll your shoulders back and open the chest.',
                    'Inhale and raise both arms, stretching the upper body upward.',
                    'Hold the posture for a few deep breaths.',
                    'To exit: release the arms and shake out the legs.',
                ],
                'benefits' => [
                    'Strengthens the back muscles',
                    'Improves posture',
                    'Stretches the upper body, including shoulders and chest',
                ],
                'contraindications' => [
                    'Avoid intense leg stretching if suffering from sciatica (mild stretching is allowed)',
                    'Back or wrist injury',
                ],
            ],
            8 => [ // Vajrasana
                'steps' => [
                    'Sit with your legs stretched forward.',
                    'Bend both knees and place your buttocks in the gap between the heels. Ensure the toes do not overlap.',
                    'Place hands on the knees, palms down. Keep back and head straight but relaxed.',
                    'Avoid excessive backward arching of the spine. Close the eyes and relax the arms and whole body.',
                    'Breathe normally and focus on the flow of air through the nostrils.',
                    'To come out: place your fists in front of the knees and lift your hips, turn the legs to one side, then slowly stretch them forward.',
                ],
                'benefits' => [
                    'Improves blood and nervous flow in the pelvic region',
                    'Strengthens pelvic muscles',
                    'Prevents hernia and relieves piles',
                    'Supports digestive health, helping with hyperacidity and ulcers',
                    'Excellent meditation posture, especially for those with sciatica',
                ],
                'contraindications' => [
                    'Ankle or knee injuries',
                ],
            ],
            9 => [ // Bhadrasana
                'steps' => [
                    'Sit in Vajrasana.',
                    'Separate the knees as far as possible, keeping the toes in contact with the floor.',
                    'Allow the buttocks and perineum to rest flat on the floor between the feet.',
                    'Gradually separate the knees further apart, without straining.',
                    'Place hands on the knees, palms down.',
                ],
                'benefits' => [
                    'Improves blood and nerve flow in the pelvic region',
                    'Strengthens pelvic muscles',
                    'Prevents hernia and relieves piles',
                    'Reduces blood flow to genitals and massages related nerve fibers',
                ],
                'contraindications' => [
                    'Joint pain or after knee/ankle surgery',
                ],
            ],
            10 => [ // Uttana Mandukasana
                'steps' => [
                    'Sit in Vajrasana. Open your knees sideways to assume Bhadrasana posture.',
                    'Inhale and lift your arms to the ceiling, stretching your upper body upwards.',
                    'Exhale and cross your hands over your head, palms touching the shoulder area (if palms do not reach, hold the elbows).',
                    'Direct your tailbone down toward the floor, straighten the spine as much as possible, and look forward.',
                    'Inhale and straighten the arms. Repeat the steps, swapping the palms.',
                    'Inhale, straighten and relax the arms, bring knees back to the center, and release the posture.',
                ],
                'benefits' => [
                    'Provides a good stretch to the back muscles',
                    'Relieves back pain',
                    'Builds cardiovascular health and resilience',
                    'Strengthens core, thighs, and ankles',
                ],
                'contraindications' => [
                    'Avoid lifting arms if you have high blood pressure',
                    'Knee issues, severe back conditions, or frozen shoulders',
                ],
            ],
            11 => [ // Manduka Asana
                'steps' => [
                    'Sit in Vajrasana.',
                    'Fold your thumbs and make a fist with both hands.',
                    'Press gently on the navel and lower belly with your fists.',
                    'Exhale and bend forward, relaxing your head.',
                    'Inhale and return to Vajrasana.',
                ],
                'benefits' => [
                    'Beneficial to all organs of the body',
                    'Relieves diabetes, digestive disorders, and constipation',
                    'Improves flexibility and mobility of knees and ankles',
                    'Tones shoulder and abdominal muscles',
                    'Helps reduce thigh and belly fat',
                ],
                'contraindications' => [
                    'Back pain or difficulty with forward bending',
                    'Knee or hip injuries',
                    'Not recommended for pregnant women',
                    'Recent surgery on the abdomen, chest, knees, or legs',
                ],
            ],
            12 => [ // Gomukhasana
                'steps' => [
                    'Sit with legs straight in front of you.',
                    'Bend the right leg over the left, placing the right heel beside the left buttock.',
                    'Bend the left leg under the right, placing the left heel beside the right buttock. Adjust the right knee above the left knee.',
                    'Stretch the arm on the side of the top leg upwards, and place the other arm behind the back, trying to clasp the palms.',
                    'Keep the spine erect and head in line with the spine. Close the eyes.',
                    'To release: reverse the steps and release the legs one by one.',
                    'Repeat with the left leg on top.',
                ],
                'benefits' => [
                    'Induces relaxation',
                    'Relieves backache, rheumatism, and shoulder/neck stiffness',
                    'Improves posture, energy, awareness, and chest opening',
                    'Alleviates leg cramps and increases leg suppleness',
                ],
                'contraindications' => [
                    'Knee, hip, hamstring, or quadriceps injuries',
                    'Sciatica',
                    'Neck or shoulder injuries',
                ],
            ],
            13 => [ // Ushtrasana
                'steps' => [
                    'Sit in Vajrasana.',
                    'Stand on the knees with legs hip-distance apart. Keep ankles relaxed.',
                    'Place hands on the lower back and hips. Open the chest and bring elbows towards each other.',
                    'Inhale and bend backward from the lower back, reaching the right heel with the right hand, then the left heel with the left hand. Keep hips forward, thighs vertical, and bend head and spine backward as comfortable.',
                    'Relax the whole body into the stretch. Weight should be evenly supported by legs and arms.',
                    'Use arms to anchor the shoulders and maintain the arch.',
                    'Hold the final position as long as comfortable, breathing steadily.',
                    'Exhale and return to starting position, releasing hands from the heels one at a time, supporting the lower back.',
                    'Rest in Balasana.',
                ],
                'benefits' => [
                    'Improves digestive and reproductive systems',
                    'Stretches stomach and intestines, alleviating constipation',
                    'Loosens vertebrae and stimulates spinal nerves',
                    'Relieves backache, rounded back, and drooping shoulders',
                ],
                'contraindications' => [
                    'Severe back ailments such as lumbago unless guided by a competent teacher',
                ],
            ],
            14 => [ // Janushirsasana
                'steps' => [
                    'Sit with legs outstretched and feet together.',
                    'Bend the left leg, placing the heel against the perineum and the sole against the inside of the right thigh. Keep the left knee on the floor.',
                    'Inhale, lift hands, and stretch the spine.',
                    'Exhale, bend forward from the lower back and grasp the right foot or ankle as possible.',
                    'Try to touch the knee with the forehead. Keep the back relaxed.',
                    'Hold as long as comfortable, breathing normally.',
                    'To release, stretch hands forward and come up with inhalation.',
                    'Repeat on the right leg.',
                ],
                'benefits' => [
                    'Stretches hamstrings',
                    'Increases hip flexibility',
                    'Tones and massages abdominal and pelvic region, including liver, pancreas, spleen, urogenital system, kidneys, and adrenal glands',
                    'Helps reduce excess weight in abdominal and pelvic areas',
                    'Stimulates spinal nerves and muscles',
                ],
                'contraindications' => [
                    'Slipped disc, sciatica, or hernia',
                ],
            ],
            15 => [ // Paschimottanasana (benefits/contraindications: "same as Janushirsasana" in source)
                'steps' => [
                    'Sit with legs stretched out, feet together, hands on knees. Relax the body.',
                    'Inhale, lift hands and stretch the spine upwards.',
                    'Exhale, fold forward from the hips, grasping toes, heels, or any reachable part of the legs.',
                    'Bend knees slightly if needed. Relax the head down.',
                    'Move slowly and gently, without forcing. Hold the position for a few seconds.',
                    'Relax back and leg muscles, ensuring abdominal muscles are relaxed.',
                    'Try to touch forehead to knees without strain.',
                    'Inhale, slowly return to starting position, aligning hands with the head.',
                ],
                'benefits' => [
                    'Stretches hamstrings',
                    'Increases hip flexibility',
                    'Tones and massages the abdominal and pelvic region',
                    'Helps reduce excess weight in abdominal and pelvic areas',
                    'Stimulates spinal nerves and muscles',
                ],
                'contraindications' => [
                    'Slipped disc, sciatica, or hernia',
                ],
            ],
            16 => [ // Vakrasana
                'steps' => [
                    'Sit on the floor with legs stretched out, hands resting on the floor by the side.',
                    'Bend the left leg, sole on the floor, keeping the right leg straight with toes stretched forward.',
                    'Place the left hand on the floor behind you, keeping the back straight. Do not lean back.',
                    'Inhale and raise the right hand. Exhale and twist the trunk left, placing the right hand over the left leg or hold the left ankle.',
                    'Turn the neck in line with the trunk.',
                    'Breathe normally, maintaining the final position as long as comfortable.',
                    'Release the pose by untwisting, returning to a forward-looking position, hands on the floor, left leg resting.',
                    'Repeat on the right side.',
                ],
                'benefits' => [
                    'Tones abdominal organs',
                    'Improves digestion and relieves constipation',
                    'Supports liver and pancreas function',
                    'Good for diabetes',
                    'Gives a twist to the spine, increasing spinal flexibility',
                ],
                'contraindications' => [
                    'Hip, shoulder, or neck injuries',
                    'Recent surgery on thorax, abdomen, or hips',
                ],
            ],
            17 => [ // Simha Garjasana
                'steps' => [
                    'Sit with legs stretched forward, fold one leg at a time, and sit on heels.',
                    'Separate knees, placing palms on the floor between the knees, fingers pointing toward the body.',
                    'Lean forward, resting the body on straight arms. Arch the back and gently tilt the head back. Open eyes and gaze at the eyebrow center.',
                    'Keep the mouth closed and relax the body. Inhale deeply through the nose.',
                    "Exhale: open the mouth, extend the tongue forward, produce a 'HA!' sound from the throat, gaze forward.",
                    'Close the mouth and return gaze to eyebrow center.',
                    'Repeat a few times. Rest in Balasana.',
                ],
                'benefits' => [
                    'Helps release suppressed emotions, improving menstrual cycle health',
                    'Improves throat, nose, ears, eyes, and mouth function',
                    'Relieves chest and diaphragm tension',
                    'Useful for stuttering or nervous, introverted individuals',
                ],
                'contraindications' => [
                    'Knee or neck injuries',
                    'High blood pressure',
                ],
            ],
            18 => [ // Yoga Mudrasana
                'steps' => [
                    'Sit in Padmasana. Take hold of one wrist behind the back. Close eyes and relax.',
                    'Exhale slowly and bend forward from the hips, synchronizing movement with the breath until forehead touches the floor.',
                    'Stay as long as comfortable.',
                    'Inhale and raise the trunk to vertical position.',
                    'Perform all movements smoothly and harmoniously.',
                ],
                'benefits' => [
                    'Massages abdominal organs',
                    'Stretches the back, promoting general health',
                    'Prepares the body for meditation',
                    'Relieves anger and tension, inducing tranquility',
                    'Develops awareness and control of psychic energy, awakens Manipura chakra',
                ],
                'contraindications' => [
                    'Sciatica, high blood pressure, pelvic inflammatory disease',
                    'Serious abdominal ailments',
                ],
            ],
            19 => [ // Bhujanga Asana
                'steps' => [
                    'Lie on your stomach, palms next to the chest under the shoulders.',
                    'Inhale and slide the chest forward, raising head, shoulders, and chest. Keep the stomach on the floor.',
                    'Keep feet together and engage back and buttock muscles.',
                    'Thighs and hips remain on the floor.',
                    'Breathe normally and hold as long as comfortable.',
                ],
                'benefits' => [
                    'Improves and deepens breathing',
                    'Removes backache',
                    'Keeps spine supple and healthy',
                    'Tones ovaries and uterus, helps with menstrual disorders',
                ],
                'contraindications' => [
                    'Peptic ulcer, hernia, intestinal tuberculosis, or hyperthyroidism',
                ],
            ],
            20 => [ // Shalabhasana
                'steps' => [
                    'Lie on your belly, palms on the ground, join feet, chin on the mat.',
                    'Place hands beneath the stomach or hip bone.',
                    'Inhale and raise the right leg as high as possible. Keep hip bones stable.',
                    'Hold for a few seconds, breathe, then lower with exhalation.',
                    'For Purna Shalabhasana, lift both legs together while keeping the upper body on the floor.',
                ],
                'benefits' => [
                    'Increases blood circulation',
                    'Reduces weight',
                    'Improves spine and waist flexibility',
                ],
                'contraindications' => [
                    'Acute back pain, severe sciatica, slipped disc',
                    'Women with prolapsed uterus should avoid',
                ],
            ],
            21 => [ // Makarasana
                'steps' => [
                    'Lie on your stomach.',
                    'Bring arms together to form a pillow, rest forehead on forearms.',
                    'Keep legs apart with toes pointing outward.',
                    'Rest and relax.',
                ],
                'benefits' => [
                    'Allows the body to rest',
                    'Improves digestion',
                ],
                'contraindications' => [
                    'Back conditions, e.g. exaggerated lumbar curve, or if pain occurs',
                ],
            ],
            22 => [ // Uttana Pada Asana
                'steps' => [
                    'Lie on the mat, feet and knees together, palms down or supporting lower back.',
                    'Inhale and slowly raise one leg to 90 degrees, without lifting shoulders.',
                    'Hold, keeping upper body relaxed. To release, exhale and slowly lower the leg.',
                    'Point toes toward yourself, bring the leg down to 45 degrees, then 10 degrees off the floor.',
                    'Use a wall if needed for support.',
                ],
                'benefits' => [
                    'Strengthens abdominal muscles',
                    'Tones all organs in the abdomen',
                    'Strengthens lower back and hamstrings',
                    'Improves digestion and relieves constipation',
                ],
                'contraindications' => [
                    'Lower back pain, blood pressure issues, spinal injury, menstruation',
                    'Consult a doctor if you have a slipped disc',
                ],
            ],
            23 => [ // Setu Bandhasana
                'steps' => [
                    'Lie on your back. Bend knees, feet hip-distance apart, 10-12 inches from pelvis.',
                    'Arms beside the body, palms down.',
                    'Inhale and lift lower, middle, and upper back off the floor. Press feet into floor.',
                    'Roll shoulders in, touch chest to chin, support with shoulders, arms, and feet.',
                    'Engage thighs parallel to each other and floor.',
                    'Interlock fingers and push hands to lift torso further, or for an easier version, support back with palms.',
                    'Breathe normally and move slowly.',
                ],
                'benefits' => [
                    'Strengthens back muscles',
                    'Relieves tired back instantly',
                    'Stretches chest, neck, spine',
                    'Reduces anxiety, stress, depression',
                    'Improves digestion',
                    'Good for menopause and menstrual pain',
                ],
                'contraindications' => [
                    'Neck or back injuries',
                ],
            ],
            24 => [ // Sarvanga Asana
                'steps' => [
                    'Lie flat on your back, legs and feet together, arms close to the body, palms down. Relax fully.',
                    'Raise both legs to 90 degrees, keeping them straight and together.',
                    'Inhale and lift your hips, moving the legs toward the ceiling.',
                    'Bend the elbows and support hips with your hands. Hands cup the hips and bear the body\'s weight.',
                    'Raise the legs to vertical position, relax the feet, keep them together.',
                    'Ensure the collarbone touches the chin and the head is centered.',
                    'Relax in the final pose as long as comfortable, keep breathing throughout.',
                    'To exit, lower legs over the head or bend them. Place arms and hands on the mat close to the body, palms down.',
                    'Slowly lower the spine vertebra by vertebra, keeping the head on the floor.',
                    'When the buttocks reach the floor, lower legs straight and relax in Shavasana.',
                ],
                'benefits' => [
                    'Helps in low blood pressure cases',
                    'Balances the nervous system',
                    'Strengthens neck muscles',
                    'Brings blood supply to the brain',
                ],
                'contraindications' => [
                    'High blood pressure, heart conditions, ear inflammation',
                    'Weak eye capillaries, severe nearsightedness',
                    'Problems in pituitary or thyroid glands, arteriosclerosis',
                    'Cerebral or other thrombosis, severe asthma, tuberculosis',
                    'Cold or sinusitis, impure blood, slipped disc, weak spine, vertigo',
                ],
            ],
            25 => [ // Halasana
                'steps' => [
                    'Follow all steps of Sarvangasana.',
                    'Slowly lower both legs behind the head.',
                    'If unable to place legs on the floor, rest them on a chair.',
                    'Once toes touch the floor, point toes outward and gently move heels toward the floor to stretch hamstrings.',
                    'Continue supporting the lower back; if possible, release support and interlock fingers with elbows stretched out.',
                    'Keep the head centered to avoid neck strain.',
                    'To exit, slowly transition back to Sarvangasana, supporting the lower back first, then follow the same steps as Sarvangasana to come out.',
                ],
                'benefits' => [
                    'Massages all internal organs',
                    'Activates digestion',
                    'Improves pancreas, liver, kidney function',
                    'Tones spinal nerves',
                    'Regulates thyroid gland',
                ],
                'contraindications' => [
                    'High blood pressure, heart conditions, hernia',
                    'Slipped disc, sciatica, serious back problems',
                    'Arthritis of the neck',
                ],
            ],
            26 => [ // Vipareeta Karani
                'steps' => [
                    'Lie flat on your back, legs and feet together, arms close to the body, palms down.',
                    'Raise legs to 90 degrees, keeping them straight and together.',
                    'Inhale and lift hips, supporting them with hands (hands cup the hips).',
                    'Turn palms up, bend elbows, let hips rest on the base of palms near wrists.',
                    'Raise legs vertically, feet relaxed. Trunk forms roughly a 45 degree angle with the floor.',
                    'Ensure the chin does not press firmly against the chest.',
                    'Relax in the final pose, breathing normally.',
                    'To exit, lower legs over the head, place arms by the body, and slowly lower the spine vertebra by vertebra.',
                    'Relax in Shavasana.',
                ],
                'benefits' => [
                    'Suitable for beginners unable to perform Sarvangasana',
                    'Similar benefits as Sarvangasana but with less neck pressure',
                ],
                'contraindications' => [
                    'High blood pressure, heart conditions, ear inflammation',
                    'Slipped disc, weak spine, vertigo',
                ],
            ],
            27 => [ // Sarala Matsyasana
                'steps' => [
                    'Lie on your back, hands alongside the body, feet together.',
                    'Lift the chest backward, supporting the body with arms and elbows.',
                    'Use elbows or place hands near shoulders to lift.',
                    'Lower the crown of the head to the floor.',
                    'Rest palms on thighs or by the sides.',
                    'Close eyes, breathe slowly and deeply.',
                    'Return to starting position, reversing movements.',
                ],
                'benefits' => [
                    'Stretches intestines and abdominal organs',
                    'Alleviates backache',
                    'Regulates thyroid function',
                    'Gives pelvic region a good stretch',
                ],
                'contraindications' => [
                    'Heart disease, peptic ulcers, hernia',
                    'Back conditions, serious illness',
                    'Pregnant women',
                ],
            ],
            28 => [ // Shavasana (no contraindications given in source)
                'steps' => [
                    'Lie on your back, legs apart, arms by the side, palms up.',
                    'Bring awareness to the body, breath, and mind.',
                    'Consciously relax every part of the body.',
                    'Stay in posture for 5-10 minutes.',
                    'Wriggle toes and fingers, move neck gently, turn to the right.',
                    'Sit upright in a cross-legged position after finishing.',
                ],
                'benefits' => [
                    'Deeply relaxes the body',
                    'Helps absorb the benefits of previous asanas',
                ],
                'contraindications' => [],
            ],
            29 => [ // Sukhasana
                'steps' => [
                    'Sit with legs straight in front.',
                    'Bend one leg and place the foot under the opposite thigh, repeat with the other leg.',
                    'Place hands on the knees in Chin Mudra or Jnana Mudra.',
                    'Keep head, neck, and back upright and straight without strain.',
                    'Close eyes, relax the whole body, arms and elbows should not be tense.',
                ],
                'benefits' => [
                    'Easiest and most comfortable meditation posture',
                    'Can be used by persons unable to sit in more advanced meditation postures',
                ],
                'contraindications' => [
                    'Difficult to sustain for long periods if knees are not close to the ground',
                    'Avoid long duration in case of stiff thighs, pain, or injured knees',
                ],
            ],
            31 => [ // Siddhasana
                'steps' => [
                    'Sit with legs straight.',
                    'Bend the right leg, placing the sole against the inner left thigh, heel pressing the perineum.',
                    'Bend the left leg and place it on top of the right thigh; heels ideally stacked.',
                ],
                'benefits' => [
                    'Channels energy from lower chakras upward, stimulating the brain',
                    'Calms the nervous system',
                    'Tones lumbar spine, pelvis, and abdominal organs',
                    'Balances reproductive system and blood pressure',
                ],
                'contraindications' => [
                    'Sciatica or sacral infections',
                ],
            ],
            32 => [ // Siddha Yoni Asana (same technique as Siddhasana, for women, per source)
                'steps' => [
                    'Sit with legs straight.',
                    'Bend the right leg, placing the sole against the inner left thigh, heel pressing the perineum.',
                    'Bend the left leg and place it on top of the right thigh; heels ideally stacked.',
                ],
                'benefits' => [
                    'Channels energy from lower chakras upward, stimulating the brain',
                    'Calms the nervous system',
                    'Tones lumbar spine, pelvis, and abdominal organs',
                    'Balances reproductive system and blood pressure',
                ],
                'contraindications' => [
                    'Sciatica or sacral infections',
                ],
            ],
            33 => [ // Ardha Padmasana
                'steps' => [
                    'Sit on floor or mat, legs stretched forward, spine erect.',
                    'Bend one leg and place the sole on the opposite thigh, heel near hip.',
                    'Bend the other leg under the opposite knee or thigh.',
                    'Place hands on knees in Chin Mudra, spine erect, head straight.',
                    'Release and repeat with the other leg.',
                ],
                'benefits' => [
                    'Stabilizes the body for long periods, calming the mind',
                    'Directs prana from Mooladhara Chakra to Sahasrara Chakra',
                    'Similar benefits to Padmasana at a reduced level',
                ],
                'contraindications' => [
                    'Sciatica, weak, or injured knees',
                ],
            ],
            34 => [ // Padmasana
                'steps' => [
                    'Sit on floor or mat, spine erect, legs stretched forward.',
                    'Bend right knee and place ankle on left thigh; bend left knee and place ankle on right thigh.',
                    'Soles point upwards, heels near hip.',
                    'Place hands on knees in Chin Mudra, spine erect, head straight.',
                    'Release legs in reverse order and swap legs.',
                ],
                'benefits' => [
                    'Ideal for Pranayama and Pratyahara',
                    'Steadies body and mind for long meditation sessions',
                    'Channels prana from Mooladhara to Sahasrara, enhancing meditation experience',
                ],
                'contraindications' => [
                    'Sciatica or weak/injured knees until flexibility improves through pre-meditation asanas',
                ],
            ],
        ];

        foreach ($content as $asanasId => $data) {
            foreach ($data['steps'] as $index => $step) {
                DB::table('asana_steps')->insert([
                    'asanas_id' => $asanasId,
                    'asana_steps' => $step,
                    'steps_order_number' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($data['benefits'] as $index => $benefit) {
                DB::table('asana_benefits')->insert([
                    'asanas_id' => $asanasId,
                    'benefit' => $benefit,
                    'sort_order' => $index + 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($data['contraindications'] as $index => $contraindication) {
                DB::table('asana_contraindications')->insert([
                    'asanas_id' => $asanasId,
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
        $asanaIds = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 31, 32, 33, 34];

        DB::table('asana_steps')->whereIn('asanas_id', $asanaIds)->delete();
        DB::table('asana_benefits')->whereIn('asanas_id', $asanaIds)->delete();
        DB::table('asana_contraindications')->whereIn('asanas_id', $asanaIds)->delete();
    }
};
