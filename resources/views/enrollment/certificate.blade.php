<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    <style>
        @page {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .position-relative {
            position: relative;
        }

        @font-face {
            font-family: 'DancingScript';
            src: url('./fonts/DancingScript.ttf') format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        .student-name {
            font-family: "DancingScript", cursive;
        }
    </style>
</head>

<body style="background-image: url(./enrollment/certificate.png); background-size: cover">
    <div>
        <div class="student-name" style="text-align: center; margin-top:295px; color: #14324b; font-size:75px">
            {{ $studentName }}
        </div>
        <div
            style="width:80%; text-align: center; margin:50px auto 0 auto; color: #2d5573; font-size:24px; font-weight:bold;">
            "{{ $courseTitle }}"
        </div>

        <div style="display:table; width:100%; color: #14324b; font-size: 27px; font-weight:bold;">
            <div style="text-align:center; display:table-cell; width:50%; padding-left: 110px">
                <div style="margin-top: 90px;">
                    <div style="font-family: DancingScript; color: black; font-weight:normal;">
                        {{ $adminName }}</div>
                </div>
                <span style="font-family: Times New Roman, Times, serif;">{{ $adminName }}</span>
            </div>
            <div style="text-align:center; display:table-cell; width:50%; padding-right: 110px">
                <div style="margin-top: 135px;">
                    <span style="font-family: Times New Roman, Times, serif;">{{ date('F jS  Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
