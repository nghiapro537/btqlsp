<?php
require_once 'config.php';
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    header("Location: index.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    if (empty($name) || $price === '' || $quantity === '') {
        $error = "Vui lòng nhập đầy đủ thông tin!";
    } else {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
        $stmt->execute([$name, $price, $quantity, $id]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
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
            background: #ffc107;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h2>Sửa thông tin sản phẩm</h2>
    <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Tên sản phẩm:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="form-group">
            <label>Giá (VNĐ):</label>
            <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" required>
        </div>
        <div class="form-group">
            <label>Số lượng:</label>
            <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>
        </div>
        <button type="submit" class="btn">Cập nhật</button>
        <a href="index.php" style="margin-left: 10px; text-decoration: none; color: #555;">Quay lại</a>
    </form>
</body>

</html>