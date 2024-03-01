<?php

include 'config.php';

if (isset($_POST['post_comment'])) {

  $name = $_POST['name'];
  $message = $_POST['message'];
  $email = $_POST['email'];

  $sql = "INSERT INTO comments (name, email, message)
		VALUES ('$name', '$email', '$message')";

  if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>D-ARCHITECT</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" href="css/komen.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body>
  <!-- loader -->
  <div class="bg-loader">
    <div class="loader"></div>
  </div>

  <!-- header -->
  <div class="medsos">
    <div class="container">
      <ul>
        <li>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-tiktok"></i></a>
        </li>
        <li>
          <a href="#"><i class="fab fa-whatsapp"></i></a>
        </li>
      </ul>
    </div>
  </div>
  <header>
    <div class="container">
      <h1><a href="index.html">D-ARCHITECT</a></h1>
      <ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="about.html">ABOUT</a></li>
        <li><a href="service.html">SERVICE</a></li>
        <li class="active"><a href="contact.html">CONTACT & FEEDBACK</a></li>
      </ul>
    </div>
  </header>

  <!-- label -->
  <section class="label">
    <div class="container">
      <p>Home / Contact</p>
    </div>
  </section>

  <!-- service -->
  <section class="service">
    <div class="container">
      <h3>CONTACT INFO</h3>
      <div class="box" style="display: flex; padding-bottom: 20px">
        <div class="address" style="width: 400px; text-align: left">
          <h4>ALAMAT</h4>
          <p>Mekarsari Raya Jl. KH. Mochammad, Tambun Selatan Bekasi, Indonesia.</p>
        </div>
        <div class="email" style="width: 400px; text-align: center;">
          <h4>EMAIL</h4>
          <p>fardhanganteng@gmail.com</p>
        </div>
        <div class="number" style="width: 400px; text-align: center; padding-left:50px;">
          <h4>NOMOR TELPON</h4>
          <p>+62 81211455226</p>
        </div>
      </div>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4079.577112437263!2d107.06125263953267!3d-6.253578042797193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698dffaa3e87c9%3A0x7f0f671bf57691ae!2sSMK%20TELEKOMUNIKASI%20TELESANDI%20BEKASI!5e0!3m2!1sid!2sid!4v1700666174443!5m2!1sid!2sid"
        width="100%" height="500px" style="border: 0" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="fb">
      <h3>FEEDBACK</h3>
    </div>
    <div class="wrapper">
      <form action="" method="post" class="form">
        <input type="text" class="name" name="name" placeholder="Name" required>
        <input type="text" class="email" name="email" value="@gmail.com" placeholder="loremipsum@gmail.com" required>
        <br>
        <textarea name="message" cols="30" rows="10" class="message" placeholder="Message" required></textarea>
        <br>
        <button type="submit" class="btn" name="post_comment" onclick="buttonPress()">Post Comment</button>
      </form>
    </div>

    <div class="content">
      <h4 class="list">List Comment
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill"
          viewBox="0 0 16 16">
          <path
            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
        </svg>
      </h4>

      <?php
      date_default_timezone_set('Asia/Jakarta');

      $sql = "SELECT * FROM comments";
      $result = $conn->query($sql);
      $waktu_sekarang = time();

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $timestamp_unix = strtotime($row['timestamp']);
          $selisih_detik = $waktu_sekarang - $timestamp_unix;

          if ($selisih_detik < 60) {
            $teks_waktu = $selisih_detik . " sec" . ($selisih_detik > 1 ? "s" : "") . " ago";
          } elseif ($selisih_detik < 3600) {
            $menit = floor($selisih_detik / 60);
            $teks_waktu = $menit . " min" . ($menit > 1 ? "s" : "") . " ago";
          } elseif ($selisih_detik < 86400) {
            $jam = floor($selisih_detik / 3600);
            $teks_waktu = $jam . " hour" . ($jam > 1 ? "s" : "") . " ago";
          } elseif ($selisih_detik < 2592000) {
            $hari = floor($selisih_detik / 86400);
            $teks_waktu = $hari . " day" . ($hari > 1 ? "s" : "") . " ago";
          } elseif ($selisih_detik < 31536000) {
            $bulan = floor($selisih_detik / 2592000);
            $teks_waktu = $bulan . " month" . ($bulan > 1 ? "s" : "") . " ago";
          } else {
            $tahun = floor($selisih_detik / 31536000);
            $teks_waktu = $tahun . " year" . ($tahun > 1 ? "s" : "") . " ago";
          }

          $tanggal = date('d-m-Y', strtotime($row['timestamp']));
          ?>
          <div class="comment">
            <h3 id="name">
              <?php echo $row['name']; ?>
            </h3>
            <h4 id="email">
              <?php echo $row['email']; ?>
            </h4>
            <div>
              <p id="message">
                <?php echo $row['message']; ?>
              </p>
            </div>
            <div>
              <h4>
                <?php echo $tanggal ?>
                <?php echo $teks_waktu ?>
              </h4>
            </div>
          </div>
        <?php }
      } ?>
    </div>

    <script>
      //PESAN
      var sensor = ["bot", "cuki", "anjing", "jelek", "kemem", "bangsat", "kontol",
        "peler", "pler", "meki", "memek", "ngentot", "babi", "ayam", "jenglot",
        "kimak", "ngentot", "gpblok"]
      function replaceTextInElements(elements) {
        elements.forEach(function (element) {

          var originalText = element.textContent;


          var newText = originalText.replace(new RegExp(sensor.join('|'), 'gi'), function (match) {

            return '*'.repeat(match.length);
          });


          element.textContent = newText;
        });
      }


      var messageElements = document.querySelectorAll('p#message');


      replaceTextInElements(messageElements);

      //NAMA
      var sensor = ["anjing", "jelek", "kemem", "bangsat",
        "kontol", "peler", "pler", "memek", "ngentot", "babi",
        "ayam", "jenglot"]
      function replaceTextInElements(elements) {
        elements.forEach(function (element) {

          var originalText = element.textContent;


          var newText = originalText.replace(new RegExp(sensor.join('|'), 'gi'), function (match) {

            return '*'.repeat(match.length);
          });


          element.textContent = newText;
        });
      }


      var messageElements = document.querySelectorAll('h3#name');


      replaceTextInElements(messageElements);
    </script>

  </section>

  <!-- footer -->
  <footer>
    <div class="container">
      <small>Copyright &copy; 2023 - Fardhan. All Rights Reserved.</small>
    </div>
  </footer>

  <script type="text/javascript">
    $(document).ready(function () {
      $(".bg-loader").hide();
    });
  </script>
</body>

</html>