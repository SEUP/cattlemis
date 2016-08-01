<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>

    <style>

        @font-face {
            font-family: "TH Niramit AS";
            src: url('{{public_path()}}/fonts/thai/TH Niramit AS.ttf');
        }

        @font-face {
            font-family: "TH Niramit AS";
            src: url('{{public_path()}}/fonts/thai/TH Niramit AS Bold.ttf');
            font-weight: bold;
        }

        @font-face {
            font-family: "TH Niramit AS";
            src: url('{{public_path()}}/fonts/thai/TH Niramit AS Italic.ttf');
            font-style: italic, oblique;
        }

        @font-face {
            font-family: "DejaVu Sans";
            src: url('{{public_path()}}/fonts/thai/TH Niramit AS Bold Italic.ttf');
            font-weight: bold;
            font-style: italic, oblique;
        }

        body {
            font-family: 'TH Niramit AS';
            font-size: 120%;
        }

        h1 {
            font-size: xx-large;
        }

        h2 {
            font-size: x-large;
        }

        p {
            text-align: justify;
            font-size: 140%;
        }

        .text-center {
            text-align: center;
        }

        .header {
            font-weight: bold;
        }


    </style>

</head>
<body>
<h1 class="text-center">แบบสอบถาม เกษตรกร</h1>
<div>
    <h2>ส่วนที่ 1 ข้อมูลพื้นฐานของเกษตรกร</h2>
    <div class="line-report">
        <label class="header">ชื่อ - นามสกุล : </label>
        {{$farmOwner->first_name}} {{$farmOwner->last_name}}
    </div>
    <div class="line-report">
        <label class="header">รหัสประจำตัวประชาชน : </label>
        {{$farmOwner->person_id}}
    </div>

</div>

</body>
</html>