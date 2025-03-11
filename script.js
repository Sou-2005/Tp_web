$(document).ready(function() {
    $("#bmiForm").submit(function(e) {
        e.preventDefault(); // منع إعادة تحميل الصفحة

        var name = $("#name").val().trim();
        var weight = parseFloat($("#weight").val());
        var height = parseFloat($("#height").val());

        if ( isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
            $("#result").html('<div style="color: red;">الرجاء إدخال بيانات صحيحة</div>');
            return;
        }

        $.ajax({
            url: "calculate.php",
            type: "POST",
            data: { name: name, weight: weight, height: height },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#result").html('<div style="color: green;">' + response.message + '</div>');
                } else {
                    $("#result").html('<div style="color: red;">' + response.message + '</div>');
                }
            },
            error: function() {
                $("#result").html('<div style="color: red;">حدث خطأ، حاول مرة أخرى</div>');
            }
        });
    });
});
