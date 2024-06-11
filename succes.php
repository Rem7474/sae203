<<<<<<< HEAD
<?php include('header.php'); 
if (isset($_GET['success'])){
    $success=$_GET['success'];
}
else{
    $success="Une erreur est survenue";
}
if (isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page="index";
}

?>
<div class="success">
  <main>
    <p><?php echo $success; ?></p>
    <p>Vous allez être redirigé dans <span id="countdown"></span> secondes...</p>
  </main>
</div>
<script>
  var countdown = 3;

  function updateCountdown() {
    var countdownElement = document.getElementById('countdown');
    countdownElement.textContent = countdown;

    if (countdown > 0) {
      countdown--;
      setTimeout(updateCountdown, 1000);
    } else {
      var page = '<?php echo $page; ?>.php';
      window.location.href = page;
    }
  }

  updateCountdown();
</script>
=======
<?php include('header.php'); 
if (isset($_GET['success'])){
    $success=$_GET['success'];
}
else{
    $success="Une erreur est survenue";
}
if (isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page="index";
}

?>
<div class="success">
  <main>
    <p><?php echo $success; ?></p>
    <p>Vous allez être redirigé dans <span id="countdown"></span> secondes...</p>
  </main>
</div>
<script>
  var countdown = 3;

  function updateCountdown() {
    var countdownElement = document.getElementById('countdown');
    countdownElement.textContent = countdown;

    if (countdown > 0) {
      countdown--;
      setTimeout(updateCountdown, 1000);
    } else {
      var page = '<?php echo $page; ?>.php';
      window.location.href = page;
    }
  }

  updateCountdown();
</script>
>>>>>>> 521457ac98f141eec458e34e9992cda7c61fff25
<?php include('footer.php'); ?>