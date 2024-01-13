  <section id="header">
    <h1>Website Header</h1>
  </section>
  <section id="body-area">
    <h1><?= $pageHeading ?></h1>
    <h3>Languages List</h3>
    <?php
      foreach($languges AS $getList){
        echo "<h4>{$getList}</h4>";
      }
    ?>

    <h3>Address List</h3>
    <?= $address ?>
  </section>