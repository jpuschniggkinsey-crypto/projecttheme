<?php
/**
 * Hunt Cards (Treasure Hunter component)
 * Felder: headline, hunts (repeater: image(id), title, author, plays, rating, link), columns (2|3|4)
 */
$headline = get_sub_field('headline');
$hunts    = get_sub_field('hunts') ?: [];
$columns  = (int) (get_sub_field('columns') ?: 3);
$col_md   = 12 / max(1, $columns);
?>
<?php if ($headline) : ?>
  <h2 class="hunt-cards__headline mb-4"><?php echo esc_html($headline); ?></h2>
<?php endif; ?>

<?php if (!empty($hunts)) : ?>
<div class="row g-4">
  <?php foreach ($hunts as $hunt) :
    $img    = $hunt['image'] ?? 0;
    $title  = $hunt['title'] ?? '';
    $author = $hunt['author'] ?? '';
    $plays  = (int) ($hunt['plays'] ?? 0);
    $rating = max(0, min(5, (float) ($hunt['rating'] ?? 0)));
    $link   = $hunt['link'] ?? [];
    $url    = is_array($link) ? ($link['url'] ?? '') : '';
    $label  = is_array($link) && !empty($link['title']) ? $link['title'] : 'Play this hunt';
    $target = is_array($link) ? ($link['target'] ?: '_self') : '_self';
  ?>
  <div class="col-12 col-md-<?php echo esc_attr($col_md); ?>">
    <article class="hunt-card h-100">

      <div class="hunt-card__image">
        <?php if ($img) echo wp_get_attachment_image($img, 'medium_large'); ?>
      </div>

      <div class="hunt-card__body">
        <?php if ($title) : ?>
          <h3 class="hunt-card__title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>

        <p class="hunt-card__meta">
          <?php if ($author) echo 'by ' . esc_html($author) . ' · '; ?>
          <?php echo esc_html($plays); ?> plays
        </p>

        <div class="stars" aria-label="<?php echo esc_attr($rating); ?> von 5 Sternen">
          <span class="stars__fill" style="width: <?php echo esc_attr($rating / 5 * 100); ?>%"></span>
        </div>

        <?php if ($url) : ?>
          <a class="btn hunt-card__btn" href="<?php echo esc_url($url); ?>" target="<?php echo esc_attr($target); ?>">
            <?php echo esc_html($label); ?>
          </a>
        <?php endif; ?>
      </div>

    </article>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
