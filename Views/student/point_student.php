<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm</title>
</head>
<body>
    <h1>Điểm</h1>
    <form method="POST" action="themhocphi.php">
        <label for="maSinhVien">Mã Sinh Viên:</label>
        <input type="text" name="maSinhVien" required><br>

        <label for="hocKy">Học Kỳ:</label>
        <input type="text" name="hocKy" required><br>

        <label for="tongHocPhi">Tổng Học Phí:</label>
        <input type="number" step="0.01" name="tongHocPhi" required><br>

        <input type="submit" value="Thêm">

        
    </form>
</body>
</html>

 