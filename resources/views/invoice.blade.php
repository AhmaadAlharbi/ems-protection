<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$employee_info->name}}</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-7f4Grn8ZZ7lbrfJjbi8h7PbrZTxldY7hM0spLCLtV9f9SLYeyp47hTc7FC4F8zx9" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>


    <style>
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: normal;
            src: url('{{ asset(' fonts/Cairo-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: bold;
            src: url('{{ asset(' fonts/Cairo-Bold.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 210mm;
            height: 297mm;
            padding: 20mm 15mm;
            box-sizing: border-box;
            position: relative;
        }

        .header,
        .footer-img {
            text-align: center;
        }

        .header img,
        .footer-img img {
            width: 100%;
            max-width: 550px;
            height: auto;
        }

        .content {
            text-align: center;
            margin: 0 10mm;
        }

        .content h5,
        .content p {
            margin: 0;
            font-size: 1rem;
        }

        .signature {
            margin-top: 20px;
            text-align: left;
        }

        .date-range {
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }

        .date-range div {
            margin: 0 5px;
        }

        .footer-img {
            margin-top: 200px;
            position: absolute;
            bottom: 10mm;
            /* Adjusted as necessary */
            width: calc(100% - 30mm);
            /* Account for page padding */
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body class="text-center">
    <div id="print" class="page text-center">
        <div class="header">
            <img class="header-img" src="{{ asset('images/new-header-1.png') }}" alt="Image">
        </div>

        <div class="content">
            <h5 class="font-weight-bold mb-4" style="margin: 8px 0;">قطاع شبكات النقل الكهربائية</h5>
            <h5 class="font-weight-bold mb-2">تكليف بمهمة خارج مقر العمل</h5>

            <div class="row mb-2 mt-2">
                <div class="col text-end">
                    <h5>السيد / مدير ادارة شؤون العاملين

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        المحترم</h5>
                    <h5>تحية طيبة وبعد</h5>
                </div>

            </div>

            <h5 class="font-weight-bold mb-5" style="margin-bottom: 14px;">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>

            <p style="margin-bottom: 8px;">الاسم: {{$employee_info->name}}</p>
            <p style="margin-bottom: 8px;">الرقم المدني: {{$employee_info->civilId}}</p>
            <p style="margin-bottom: 8px;">رقم الملف: {{$employee_info->fileNo}}</p>
            <p class="mt-3">بالإشارة إلى الموضوع أعلاه، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر العمل
                لقسم (الوقاية) إدارة صيانة محطات التحويل الرئيسية</p>

            <div class="date-range">
                <div>من الفترة: {{$firstValue}} إلى الفترة {{$lastValue}}</div>

            </div>

            <p class="">وذلك لإجراء اللازم</p>
            <p style="margin-top: 14px;">مع أطيب التمنيات،،،</p>
            <div class="signature">
                <h5 style="margin: 14px 0;">مدير إدارة صيانة محطات التحويل الرئيسية</h5>
            </div>
        </div>

        <div class="footer-img">
            <img src="{{ $footer_image_path }}" alt="Footer Image">
        </div>
    </div>

    {{-- 2nd page --}}
    <div class="header">
        <img src="{{ $header2_image_path }}" alt="Header Image">
        <div class="content">
            <h5 class="font-weight-bold mb-4" style="margin: 8px 0;">قطاع شبكات النقل الكهربائية</h5>
            <h5 class="font-weight-bold mb-2">تكليف بمهمة خارج مقر العمل</h5>

            <div class="row mb-2 mt-2">
                <div class="col text-end">
                    <h5>السيد / مدير ادارة شؤون العاملين

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        المحترم</h5>
                    <h5>تحية طيبة وبعد</h5>
                </div>

            </div>

            <h5 class="font-weight-bold mb-5" style="margin-bottom: 14px;">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>

            <p style="margin-bottom: 8px;">الاسم: {{$employee_info->name}}</p>
            <p style="margin-bottom: 8px;">الرقم المدني: {{$employee_info->civilId}}</p>
            <p style="margin-bottom: 8px;">رقم الملف: {{$employee_info->fileNo}}</p>
            <p class="mt-3">بالإشارة إلى الموضوع أعلاه، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر العمل
                لقسم (الوقاية) إدارة صيانة محطات التحويل الرئيسية</p>

            <div class="date-range">
                <div>من الفترة: {{$firstValue}} إلى الفترة {{$lastValue}}</div>

            </div>

            <p class="">وذلك لإجراء اللازم</p>
            <p style="margin-top: 14px;">مع أطيب التمنيات،،،</p>
            <p style="text-align: right;margin:70px 0 ;">المسؤول المباشر</p>
            <div class="signature">
                <h5 style="margin: 14px 0;">مدير إدارة صيانة محطات التحويل الرئيسية</h5>
            </div>
        </div>
    </div>
    {{--3rd page--}}
    <div class="header" style="margin-top: 200px;">
        <img src="{{ $header2_image_path }}" alt="Header Image">
        <div class="content">
            <h5 class="font-weight-bold mb-4" style="margin: 8px 0;">قطاع شبكات النقل الكهربائية</h5>
            <h5 class="font-weight-bold mb-2">تكليف بمهمة خارج مقر العمل</h5>

            <div class="row mb-2 mt-2">
                <div class="col text-end">
                    <h5>السيد / مدير ادارة شؤون العاملين

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        المحترم</h5>
                    <h5>تحية طيبة وبعد</h5>
                </div>

            </div>

            <h5 class="font-weight-bold mb-5" style="margin-bottom: 14px;">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>

            <p style="margin-bottom: 8px;">الاسم: {{$employee_info->name}}</p>
            <p style="margin-bottom: 8px;">الرقم المدني: {{$employee_info->civilId}}</p>
            <p style="margin-bottom: 8px;">رقم الملف: {{$employee_info->fileNo}}</p>
        </div>
        <div class="table-responsive">
            <table id="tableId" class="table text-center table-bordered table-hover"
                style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f0f0f0;">
                        <th style="padding: 10px; border: 1px solid #000;">#</th>
                        <th style="padding: 10px; border: 1px solid #000;">اليوم</th>
                        <th style="padding: 10px; border: 1px solid #000;">التاريخ</th>
                        <th style="padding: 10px; border: 1px solid #000;">حضور</th>
                        <th style="padding: 10px; border: 1px solid #000;">اثبات التواجد</th>
                        <th style="padding: 10px; border: 1px solid #000;">انصراف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee_takleef as $index => $x)
                    <tr style="background-color: #ffffff; border-bottom: 1px solid #000;">
                        <td style="padding: 10px; border: 1px solid #000;">{{ $index + 1 }}</td>
                        <td style="padding: 10px; border: 1px solid #000;">
                            @switch(\Carbon\Carbon::parse($x->date)->englishDayOfWeek)
                            @case('Sunday')
                            الأحد
                            @break
                            @case('Monday')
                            الاثنين
                            @break
                            @case('Tuesday')
                            الثلاثاء
                            @break
                            @case('Wednesday')
                            الأربعاء
                            @break
                            @case('Thursday')
                            الخميس
                            @break
                            @case('Friday')
                            الجمعة
                            @break
                            @case('Saturday')
                            السبت
                            @break
                            @endswitch
                        </td>
                        <td style="padding: 10px; border: 1px solid #000;">{{ $x->date }}</td>
                        <td style="padding: 10px; border: 1px solid #000;">{{ isset($x->employee_in) ? $x->employee_in :
                            '-' }}</td>
                        <td style="padding: 10px; border: 1px solid #000;">{{ isset($x-> in_confirmation) ? $x->
                            in_confirmation :
                            '-' }}</td>

                        <td style="padding: 10px; border: 1px solid #000;">{{ isset($x->employee_out) ? $x->employee_out
                            : '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>



        </div>


        <div class="signature">
            <h5>موافقة رئيس القسم
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                اعتماد مدير الإدارة
            </h5>
        </div>
    </div>
    </div>
</body>

</html>