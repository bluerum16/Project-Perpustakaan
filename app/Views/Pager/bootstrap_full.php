<?php
// app/Views/Pager/bootstrap_full.php
// $pager tersedia otomatis di template
$pager->setSurroundCount(2);
?>

<?php if ($pager->getPageCount() > 1): ?>
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center mb-0">
    <!-- First -->
    <?php if ($pager->hasPrevious()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="First">
          <span aria-hidden="true">&laquo;&laquo;</span>
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">&laquo;&laquo;</span></li>
    <?php endif; ?>

    <!-- Previous -->
    <?php if ($pager->hasPrevious()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    <?php endif; ?>

    <!-- Pages -->
    <?php foreach ($pager->links() as $link): ?>
      <?php if ($link['active']): ?>
        <li class="page-item active" aria-current="page"><span class="page-link"><?= $link['title'] ?></span></li>
      <?php else: ?>
        <li class="page-item"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
      <?php endif; ?>
    <?php endforeach; ?>

    <!-- Next -->
    <?php if ($pager->hasNext()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    <?php endif; ?>

    <!-- Last -->
    <?php if ($pager->hasNext()): ?>
      <li class="page-item">
        <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="Last">
          <span aria-hidden="true">&raquo;&raquo;</span>
        </a>
      </li>
    <?php else: ?>
      <li class="page-item disabled"><span class="page-link">&raquo;&raquo;</span></li>
    <?php endif; ?>
  </ul>
</nav>
<?php endif; ?>