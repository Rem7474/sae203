<?php include('header.php'); 
if (isset($_GET['error'])){
    $error=$_GET['error'];
}
else{
    $error="Une erreur est survenue";
}
if (isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page="index";
}

?>
<div class="error">
  <main>
    <p>Une erreur est survenue : <?php echo $error; ?></p>
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
<?php include('footer.php'); ?>