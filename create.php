<?php
require_once 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    if (empty($name) || $price === '' || $quantity === '') {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    } elseif ($price < 0 || $quantity < 0) {
        $error = "Giá và số lượng không được âm!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $quantity]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        form {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h2>Thêm sản phẩm mới</h2>
    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Giá (VNĐ):</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Số lượng:</label>
            <input type="number" name="quantity" required>
        </div>
        <button type="submit" class="btn">Lưu sản phẩm</button>
        <a href="index.php" style="margin-left: 10px; text-decoration: none; color: #555;">Quay lại</a>
    </form>
</body>

</html>