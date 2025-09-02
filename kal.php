<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            height: 100vh;
            background-color: brown;
        }
        .anjay {
            height: auto;
            width: 500px;
            border-radius: 10px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
            background-color: rgb(255, 255, 255);
            padding-bottom: 20px;
        }
        h2 {
            text-align: center;
            padding: 20px;
            color: rgb(252, 252, 252);
        }
        .ucup {
            padding: 20px;
            text-align: center;
        }
        #hasil {
            text-align: center;
            font-size: 15px;
            margin-top: 10px;
            height: 30px;
            width: 400px;
        }
        h1 {
            padding-top: 35px;
            text-align: center;
            color: rgb(151, 58, 58);
        }
    </style>
</head>
<body>
    <div class="anjay">
        <h1>Kalkulator Alakadarnya</h1>
        <form method="post" id="calcForm">
            <div class="ucup">
                <label for="bil_a">Bilangan A:</label>
                <input type="number" name="bil_a" id="bil_a" required value="<?php echo isset($_POST['bil_a']) ? htmlspecialchars($_POST['bil_a']) : ''; ?>"><br><br>
                
                <label for="bil_b">Bilangan B:</label>
                <input type="number" name="bil_b" id="bil_b" required value="<?php echo isset($_POST['bil_b']) ? htmlspecialchars($_POST['bil_b']) : ''; ?>"><br><br>
                
                <label for="operation">Operasi:</label>
                <select name="operation" id="operation" required>
                    <option value="+" <?php if(isset($_POST['operation']) && $_POST['operation']=='+') echo 'selected'; ?>>+</option>
                    <option value="-" <?php if(isset($_POST['operation']) && $_POST['operation']=='-') echo 'selected'; ?>>-</option>
                    <option value="*" <?php if(isset($_POST['operation']) && $_POST['operation']=='*') echo 'selected'; ?>>*</option>
                    <option value="/" <?php if(isset($_POST['operation']) && $_POST['operation']=='/') echo 'selected'; ?>>/</option>
                </select><br><br>
                
                <button type="submit">Hitung</button> <br>

                <input type="text" id="hasil" readonly value=" <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $bil_a = isset($_POST['bil_a']) ? floatval($_POST['bil_a']) : 0;
                    $bil_b = isset($_POST['bil_b']) ? floatval($_POST['bil_b']) : 0;
                    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
                    $result = '';
                    switch ($operation) {
                        case '+':
                            $result = $bil_a + $bil_b;
                            break;
                        case '-':
                            $result = $bil_a - $bil_b;
                            break;
                        case '*':
                            $result = $bil_a * $bil_b;
                            break;
                        case '/':
                            if ($bil_b != 0) {
                                $result = $bil_a / $bil_b;
                            } else {
                                $result = 'Error: Pembagian dengan nol tidak diizinkan.';
                            }
                            break;
                        default:
                            $result = 'Operasi tidak valid.';
                    }
                    echo "Hasil = $bil_a $operation $bil_b = $result";
                }
                ?>">
                <p style="text-align: center; color: rgb(0, 0, 0);"><span style="font-weight: bold;">Warning!</span> 10 detik setelah operasi selesai, program akan otomatis di reset</p>
            </div>
        </form>
    </div>
    <br><br>
    <p style="text-align: center; color: white;">Kalkulator alakadarnya, begitupun styling-nya... alakadarnya</p>
    <script>
        // Reset form dan hasil setelah 10 detik jika ada hasil
        window.onload = function() {
            var hasil = document.getElementById('hasil');
            if (hasil.value !== "") {
                setTimeout(function() {
                    document.getElementById('calcForm').reset();
                    hasil.value = "";
                }, 10000);
            }
        };
    </script>
</body>
</html>