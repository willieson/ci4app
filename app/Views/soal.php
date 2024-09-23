<?php
// Fungsi untuk menghasilkan soal matematika acak dengan hasil bilangan bulat atau desimal (2 digit)
function generateRandomMathProblem()
{
    $numOperators = rand(1, 5);  // Jumlah operator acak (1 sampai 5)
    $num1 = rand(1, 50);  // Angka pertama acak
    $operators = ['+', '-', '*', '/'];  // Operator yang mungkin

    // Membangun soal secara dinamis
    $expression = "$num1";
    $result = $num1;

    // Array untuk menyimpan angka dan operator
    $numbers = [$num1];
    $ops = [];

    for ($i = 0; $i < $numOperators; $i++) {
        $operator = $operators[array_rand($operators)];  // Operator acak
        $numNext = rand(1, 50);  // Angka berikutnya acak

        // Pastikan hasil pembagian menghasilkan bilangan bulat atau desimal
        if ($operator == '/') {
            // Jika pembagian, kita pastikan angka bukan 0
            while ($numNext == 0) {
                $numNext = rand(1, 50);
            }
        }

        // Simpan angka dan operator
        $numbers[] = $numNext;
        $ops[] = $operator;

        // Gabungkan ke dalam ekspresi
        $expression .= " $operator $numNext";
    }

    // Evaluasi hasil dengan memperhatikan urutan operator
    $result = evaluateExpression($numbers, $ops);

    // Simpan soal dan hasil dalam sesi
    session_start();
    $_SESSION['math_problem'] = [
        'expression' => $expression,
        'result' => round($result, 2)  // Rounding hasil hingga 2 digit di belakang koma
    ];

    // Kembalikan soal (hanya ekspresi)
    echo $expression . " = ?";
}

// Fungsi untuk mengevaluasi ekspresi matematika
function evaluateExpression($numbers, $ops)
{
    // Hitung perkalian dan pembagian terlebih dahulu
    $tempNumbers = [];
    $tempOps = [];

    for ($i = 0; $i < count($ops); $i++) {
        if ($ops[$i] == '*' || $ops[$i] == '/') {
            if ($ops[$i] == '*') {
                $numbers[$i + 1] = $numbers[$i] * $numbers[$i + 1];
            } else {
                $numbers[$i + 1] = $numbers[$i] / $numbers[$i + 1];
            }
        } else {
            $tempNumbers[] = $numbers[$i];
            $tempOps[] = $ops[$i];
        }
    }
    $tempNumbers[] = $numbers[count($numbers) - 1]; // Menambahkan angka terakhir

    // Hitung penjumlahan dan pengurangan
    $result = array_shift($tempNumbers);
    foreach ($tempOps as $key => $op) {
        if ($op == '+') {
            $result += $tempNumbers[$key];
        } else if ($op == '-') {
            $result -= $tempNumbers[$key];
        }
    }

    return $result;
}

// Panggil fungsi untuk menghasilkan soal
generateRandomMathProblem();
