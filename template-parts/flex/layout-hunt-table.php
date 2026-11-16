<?php
/**
 * Hunt Table (Treasure Hunter component)
 * Felder: headline, rows (repeater: title, author, plays, rating)
 */
$headline = get_sub_field('headline');
$rows     = get_sub_field('rows') ?: [];
?>
<?php if ($headline) : ?>
  <h2 class="hunt-table__headline mb-4"><?php echo esc_html($headline); ?></h2>
<?php endif; ?>

<?php if (!empty($rows)) : ?>
<div class="hunt-table__wrapper">
  <table class="hunt-table">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Play count</th>
        <th scope="col">Rating</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row) :
        $rating = max(0, min(5, (float) ($row['rating'] ?? 0)));
      ?>
      <tr>
        <td><?php echo esc_html($row['title'] ?? ''); ?></td>
        <td><?php echo esc_html($row['author'] ?? ''); ?></td>
        <td><?php echo esc_html(number_format_i18n((int) ($row['plays'] ?? 0))); ?></td>
        <td>
          <div class="stars" aria-label="<?php echo esc_attr($rating); ?> von 5 Sternen">
            <span class="stars__fill" style="width: <?php echo esc_attr($rating / 5 * 100); ?>%"></span>
          </div>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php endif; ?>
