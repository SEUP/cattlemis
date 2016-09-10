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
<h1 class="text-center">แบบสอบถามเกษตรกรผู้เลี้ยงโคเนื้อ</h1>

@include("admin.questionaire.export.part1")
@include("admin.questionaire.export.part2")
@include("admin.questionaire.export.part3")
@include("admin.questionaire.export.part4")
@include("admin.questionaire.export.part5")
@include("admin.questionaire.export.part6")
@include("admin.questionaire.export.part7")
@include("admin.questionaire.export.part8")



</body>
</html>