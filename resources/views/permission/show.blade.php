<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Noto Naskh Arabic', serif;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="px-20  flex flex-col justify-center border py-10 ">
    <header class="flex flex-col justify-center items-center mt-15  mt-10">
        <h1 class="text-3xl font-bold mb-4">دولة الكويت</h1>
        <h2 class="text-2xl font-bold mb-4">وزارة الكهرباء والماء</h2>
        <h2 class="text-xl font-bold mb-4">إدارة شؤون العاملين</h2>
        <h3 class="text-lg font-bold">طلب استئذان ({{$permission_count}})</h3>
    </header>
    <div class=" text-right px-16 @media print px-4">
        <div class="mt-14">
            <h4 class="text-xl">السيد / مدير ادارة شؤون العاملين المحترم</h4>
            <p class="text-lg">تحية طيبة وبعد،،،</p>
        </div>
        <div class="mt-10">
            <div class="flex items-center space-x-4">
                <p>أرجو التفضل بالسماح لي بمغادرة عملي خلال يوم {{$dayInArabic}} الموافق</p>
                <p>{{$permission->date}} </p>
            </div>
            <P>وذلك للأسباب التالية : <span>{{$permission->reason}}</span></P>
            <P class="text-center mt-8 text-2xl italic underline">مع أطيب التمنيات</P>
        </div>
        <div class="mt-16">
            <div class="flex justify-around items-center  ">
                <div class="border border-dashed px-10 bg-gray-100 py-4 mt-10 space-y-4">
                    @if($permission->status == 'in')
                    <h2 class="text-center">استئذان مسبق</h2>
                    <h3>وقت الدخول : <span>{{$permission->time}}</span></h3>
                    @else
                    <h2 class="text-center">استئذان خروج</h2>
                    <h3>وقت الخروج : <span>{{$permission->time}}</span></h3>

                    @endif
                </div>

                <div class="mt-10 border border-dotted px-10 py-4 bg-gray-50">
                    <p> اسم الموظف : {{$permission->employee->name}}</p>
                    <p> رقم الملف : {{$permission->employee->fileNo}}</p>
                    <p> الرقم المدني : {{$permission->employee->civilId}}</p>

                </div>


            </div>
            <div class="my-10 font-bold text-left max-w-7xl">
                <p class="mb-4">رئيس القسم </p>
                <p>مدير ادارة صيانة محطات التحويل الرئيسية</p>
            </div>

            <div>

            </div>
        </div>

    </div>
</body>

</html>