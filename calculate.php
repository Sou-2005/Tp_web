<?php
header('Content-Type: application/json');

if(isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    $name = htmlspecialchars($_POST['name']);
    $weight = floatval($_POST['weight']);
    $height = floatval($_POST['height']);

    if ($weight <= 0 || $height <= 0) {
        echo json_encode(['success' => false, 'message' => 'الوزن والطول يجب أن يكونا أكبر من 0.']);
        exit;
    }

    $bmi = $weight / ($height * $height);
    
    if ($bmi < 18.5) {
        $interpretation = "نقص في الوزن";
    } elseif ($bmi < 25) {
        $interpretation = "وزن طبيعي";
    } elseif ($bmi < 30) {
        $interpretation = "زيادة في الوزن";
    } else {
        $interpretation = "سمنة";
    }

    $message = "مرحبًا $name، مؤشر كتلة جسمك هو " . number_format($bmi, 2) . " ($interpretation)";
    
    echo json_encode(['success' => true, 'bmi' => $bmi, 'message' => $message]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'لم يتم استلام البيانات بشكل صحيح.']);
exit;
?>
