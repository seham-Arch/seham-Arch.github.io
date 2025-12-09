<?php
// هذا ملف معالجة نموذج الاتصال
// في بيئة الإنتاج الحقيقية، يجب إضافة المزيد من التحقق من الأمان ومعالجة الأخطاء

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // جمع البيانات من النموذج
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = strip_tags(trim($_POST["message"]));
    
    // التحقق من صحة البيانات
    if (empty($name) || empty($email) || empty($message)) {
        // إرجاع خطأ إذا كانت الحقول المطلوبة فارغة
        http_response_code(400);
        echo "يرجى ملء جميع الحقول المطلوبة.";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // إرجاع خطأ إذا كان البريد الإلكتروني غير صالح
        http_response_code(400);
        echo "يرجى إدخال عنوان بريد إلكتروني صالح.";
        exit;
    }
    
    // في بيئة الإنتاج الحقيقية، هنا سيتم إرسال البريد الإلكتروني
    // $to = "nora.cohen@example.com";
    // $subject = "طلب جديد من موقع المهندسة المعمارية: $name";
    // $email_content = "الاسم: $name\n";
    // $email_content .= "البريد الإلكتروني: $email\n";
    // $email_content .= "الهاتف: $phone\n";
    // $email_content .= "الخدمة المطلوبة: $service\n\n";
    // $email_content .= "الرسالة:\n$message\n";
    // $email_headers = "From: $name <$email>";
    
    // if (mail($to, $subject, $email_content, $email_headers)) {
    //     http_response_code(200);
    //     echo "شكرًا لك! تم استلام رسالتك بنجاح.";
    // } else {
    //     http_response_code(500);
    //     echo "عذرًا! حدث خطأ أثناء إرسال رسالتك. يرجى المحاولة مرة أخرى لاحقًا.";
    // }
    
    // لأغراض العرض، سنعود بنجاح مباشرة
    http_response_code(200);
    echo "شكرًا لك! تم استلام رسالتك بنجاح.";
    
} else {
    // إذا لم يكن النموذج مرسلاً بطريقة POST
    http_response_code(403);
    echo "حدث خطأ أثناء إرسال النموذج. يرجى المحاولة مرة أخرى.";
}
?>