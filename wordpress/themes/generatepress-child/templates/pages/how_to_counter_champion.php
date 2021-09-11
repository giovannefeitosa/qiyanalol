<article class="how-to-counter-champion">
  <header
    class="counter-header"
  >
    <h1 class="counter-title">
      Stats de counter de
      <span class="title-champion-1">Qiyana</span>
      com
      <span class="title-champion-2"><?= $champion['name']; ?></span>
    </h1>

    <div class="champions-images">
      <div
        class="champion-image champion-1-image"
        style="background-image:url('<?=$qiyana['image'];?>');"
      ></div>
      <div class="vs-icon">
        <img src="<?=QURL::assetUrl('img/vs.png');?>" />
      </div>
      <div
        class="champion-image champion-2-image"
        style="background-image:url('<?=$champion['image'];?>');"
      ></div>
    </div>
  </header>
</article>
