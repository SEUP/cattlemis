<?php

use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $choiceArr = [
            ["choice" => "ชาย", "type" => "sex", "has_text" => false],
            ["choice" => "หญิง", "type" => "sex", "has_text" => false],

            ["choice" => "หัวหน้าครอบครัว", "type" => "family_status", "has_text" => false],
            ["choice" => "ภรรยา", "type" => "family_status", "has_text" => false],
            ["choice" => "บุตร", "type" => "family_status", "has_text" => false],
            ["choice" => "อื่นๆ", "type" => "family_status", "has_text" => true],

            ["choice" => "ประถมศึกษา", "type" => "education", "has_text" => false],
            ["choice" => "มัธยมศึกษา", "type" => "education", "has_text" => false],
            ["choice" => "ปวช", "type" => "education", "has_text" => false],
            ["choice" => "ปวส", "type" => "education", "has_text" => false],
            ["choice" => "ปริญญาตรี", "type" => "education", "has_text" => false],
            ["choice" => "สูงกว่าปริญญาตรี", "type" => "education", "has_text" => false],
            ["choice" => "ไม่ได้ศึกษา", "type" => "education", "has_text" => false],

            ["choice" => "ไม่มีตำแหน่ง", "type" => "social_status", "has_text" => false],
            ["choice" => "กรรมการหมู่บ้าน", "type" => "social_status", "has_text" => false],
            ["choice" => "สมาชิก อบต", "type" => "social_status", "has_text" => false],
            ["choice" => "ผู้ใหญ่บ้าน", "type" => "social_status", "has_text" => false],
            ["choice" => "อื่นๆ", "type" => "social_status", "has_text" => true],

            ["choice" => "อาชีพหลัก", "type" => "cattle_job", "has_text" => false],
            ["choice" => "อาชีพเสริม", "type" => "cattle_job", "has_text" => false],

            ["choice" => "ทำนา", "type" => "jobtype", "has_text" => false],
            ["choice" => "เลี้ยงโคเนื้อ", "type" => "jobtype", "has_text" => false],
            ["choice" => "รับจ้าง", "type" => "jobtype", "has_text" => false],
            ["choice" => "ประมง", "type" => "jobtype", "has_text" => false],
            ["choice" => "ข้าราชการ", "type" => "jobtype", "has_text" => false],
            ["choice" => "ค้าขาย", "type" => "jobtype", "has_text" => false],
            ["choice" => "ทำสวน", "type" => "jobtype", "has_text" => true],
            ["choice" => "ทำไร่", "type" => "jobtype", "has_text" => true],
            ["choice" => "อื่นๆ", "type" => "jobtype", "has_text" => true],


            ["choice" => "1,000 - 10,000 บาท/ปี", "type" => "income_range", "has_text" => false],
            ["choice" => "10,000 - 50,000 บาท/ปี", "type" => "income_range", "has_text" => false],
            ["choice" => "50,000 - 100,000 บาท/ปี", "type" => "income_range", "has_text" => false],
            ["choice" => "100,000 - 150,000 บาท/ปี", "type" => "income_range", "has_text" => false],
            ["choice" => "มากกว่า 150,000 บาท/ปี", "type" => "income_range", "has_text" => false],

        ];


        foreach ($choiceArr as $choice) {
            $c = new \App\Models\Choice();
            $c->fill($choice);
            $c->save();
        }
    }
}

