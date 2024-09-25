<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{

    public function index()
    {
        // Cek apakah session status ada dan benar
        if (session()->get('status') !== 'true') {
            return redirect()->route('login');
        }

        // Ambil oauth_id dari session
        $user_id = session()->get('user_id');

        if ($user_id) {
            $user_data = $this->userModel->where('id', $user_id)->first();
        } else {
            return redirect()->route('logout');
        }
        $data = [
            'title' => 'Home | CI4 - Michael',
            'user_data' => $user_data
        ];



        return view('index', $data);
    }

    public function connTest()
    {
        $db = \Config\Database::connect();
        if ($db->connect()) {
            echo "Koneksi ke database berhasil!";
        } else {
            echo "Koneksi ke database gagal!";
        }
    }

    public function market()
    {
        // Cek apakah session status ada dan benar
        if (session()->get('status') !== 'true') {
            return redirect()->route('login');
        }

        // Ambil oauth_id dari session
        $user_id = session()->get('user_id');

        if ($user_id) {
            $user_data = $this->userModel->where('id', $user_id)->first();
        } else {
            return redirect()->route('logout');
        }
        $data = [
            'title' => 'Market | CI4 - Michael',
            'user_data' => $user_data
        ];

        return view('market', $data);
    }

    public function getCimol()
    {
        // Cek apakah session status ada dan benar
        if (session()->get('status') !== 'true') {
            return redirect()->route('login');
        }

        // Ambil oauth_id dari session
        $user_id = session()->get('user_id');

        if ($user_id) {
            $user_data = $this->userModel->where('id', $user_id)->first();
        } else {
            return redirect()->route('logout');
        }
        $data = [
            'title' => 'Get Cimol | CI4 - Michael',
            'user_data' => $user_data
        ];

        return view('cimol', $data);
    }

    public function generate()
    {
        // Logika untuk menghasilkan soal matematika
        $numOperators = rand(1, 5);
        $num1 = rand(1, 50);
        $operators = ['+', '-', '*', '/'];

        $expression = "$num1";
        $numbers = [$num1];
        $ops = [];

        for ($i = 0; $i < $numOperators; $i++) {
            $operator = $operators[array_rand($operators)];
            $numNext = rand(1, 50);

            if ($operator == '/') {
                while ($numNext == 0) {
                    $numNext = rand(1, 50);
                }
            }

            $numbers[] = $numNext;
            $ops[] = $operator;
            $expression .= " $operator $numNext";
        }

        $result = $this->evaluateExpression($numbers, $ops);
        session()->set('math_problem', [
            'expression' => $expression,
            'result' => round($result, 2)
        ]);

        return $expression . " = ?";
    }

    private function evaluateExpression($numbers, $ops)
    {
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
        $tempNumbers[] = $numbers[count($numbers) - 1];

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

    public function checkAnswer()
    {
        $message = '';

        if ($this->request->getMethod() == 'post') {
            // Ambil jawaban pengguna dan hasil yang benar
            $user_answer = floatval($this->request->getPost('answer')); // Gunakan floatval untuk mendukung desimal
            $mathProblem = session()->get('math_problem');

            // Cek apakah soal ada dalam sesi
            if ($mathProblem) {
                $correct_answer = $mathProblem['result'];

                function customRandWithDynamicProbability()
                {
                    // Definisikan angka dan persentase peluang dalam array
                    $probabilities = [
                        10 => 20,
                        15 => 15,
                        20 => 10,
                        30 => 1,
                        50 => 0.1
                    ];

                    // Hitung total peluang
                    $totalPercentage = array_sum($probabilities);

                    // Hasilkan angka acak dari 1 hingga 10000 untuk probabilitas
                    $probability = rand(1, 10000);

                    // Variabel untuk melacak probabilitas kumulatif
                    $cumulative = 0;

                    // Iterasi melalui angka-angka dan peluangnya
                    foreach ($probabilities as $number => $percentage) {
                        // Perbesar peluang menjadi basis 10000 untuk presisi (misalnya 30% -> 3000)
                        $cumulative += $percentage * 100;

                        // Jika angka acak berada dalam rentang kumulatif saat ini, kembalikan angka tersebut
                        if ($probability <= $cumulative) {
                            return $number;
                        }
                    }

                    // Jika tidak ada angka khusus yang terpenuhi, kembalikan angka acak antara 1 hingga 5
                    return rand(1, 5);
                }

                // Controller code
                if (round($user_answer, 2) === round($correct_answer, 2)) {
                    $random_cimol = customRandWithDynamicProbability();  // Panggil fungsi custom
                    $message = "Congratulation! You Got = " . $random_cimol . " Cimol's";
                    // Tambahkan cimol ke database dengan rumus $random_cimol - 2
                } else {
                    $message = "Oops!!! Try Again. Answer =  " . round($correct_answer, 2);
                    // Kurangi cimol dari database
                }


                // Simpan pesan dalam sesi
                session()->set('message', $message);
            } else {
                $message = "Soal tidak ditemukan.";
                session()->set('message', $message);
            }
        }

        return redirect()->route('cimol'); // Redirect ke halaman utama
    }
}
