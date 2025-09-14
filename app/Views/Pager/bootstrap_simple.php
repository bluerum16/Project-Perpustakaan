<?php
// app/Views/Pager/bootstrap_simple.php
$pager->setSurroundCount(1);
?>

<?php if ($pager->getPageCount() > 1): ?>
<nav aria-label="Simple pagination">
  <ul class="pagination justify-content-center mb-0">
    <?php if ($pager->hasPreviousPage()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
          &laquo; Prev
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">&laquo; Prev</span></li>
    <?php endif; ?>

    <!-- show a small block of page links -->
    <?php foreach ($pager->links() as $link): ?>
      <?php if ($link['active']): ?>
        <li class="page-item active"><span class="page-link"><?= $link['title'] ?></span></li>
      <?php else: ?>
        <li class="page-item"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($pager->hasNextPage()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="Next">
          Next &raquo;
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
    <?php endif; ?>
  </ul>
</nav>
<?php endif; ?>