<?= $this->extend('headfoot'); ?>
<?= $this->section('content'); ?>

<script>
  // Fungsi JavaScript untuk memanggil soal dari server menggunakan AJAX
  function generateMathProblem() {
    // Tampilkan dialog konfirmasi sebelum membuat soal baru
    var confirmAction = confirm("Are You sure to use 2 cimol's?");
    if (confirmAction) {
      document.getElementById('question').innerHTML = "Preparing...";
      document.getElementById('generateButton').style.display = 'none'; // Sembunyikan tombol buat soal
      // Jika pengguna memilih 'Yes', jalankan pembuatan soal
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "math/generate", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          document.getElementById('question').innerHTML = xhr.responseText;
          document.getElementById('answerForm').style.display = 'block';
        }
      };
      xhr.send();
    } else {
      // Jika pengguna memilih 'No', batalkan tindakan
      return false;
    }
  }

  // Fungsi untuk menyembunyikan tombol submit setelah diklik
  function hideSubmitButton() {
    document.querySelector('button[type="submit"]').style.display = 'none'; // Sembunyikan tombol submit
    return true; // Lanjutkan untuk submit form
  }

  // Tampilkan pesan jika ada
  window.onload = function() {
    <?php if (session()->get('message')): ?>
      alert("<?= session()->get('message') ?>");
      <?php session()->remove('message'); // Hapus pesan setelah ditampilkan 
      ?>
    <?php endif; ?>
  };

  function showGenerateButton() {
    document.getElementById('generateButton').style.display = 'block'; // Tampilkan tombol buat soal
  }
</script>
<style>
  #answerForm {
    display: none;
  }
</style>

<section class="first-box">
  <div class="container">
    <div class="row">
      <div class="col">

        <h4 id="question">Pay with 2 Cimol, And Get More Cimol
        </h4>

        <button id="generateButton" class="btn btn-primary" onclick="generateMathProblem()">Get Cimol</button>

        <form id="answerForm" method="POST" action="check_answer" onsubmit="return hideSubmitButton();">
          <div class="col d-flex">
            <input class="form-control" style="width: auto;" type="text" name="answer" placeholder="Answer" required>
            <button class="btn btn-success" type="submit">Checking</button>
          </div>
        </form>
        <p>If the answer is a decimal number then use the symbol . two digits after the decimal point to round up<br>
          Example: 1.3666666 = 1.37</p>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>