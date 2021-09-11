<?php foreach($champions as $champ) { ?>
  <a
    href="<?=QURL::counterChampion($champ['slug']);?>"
    style="display: inline-block; vertical-align: top; margin: 5px; text-align: center; width: 100px;"
  >
    <div>
      <img src="<?= $champ['thumbnail']; ?>" width="64" height="64" />
    </div>

    <?= $champ['name']; ?>
  </a>
<?php }
