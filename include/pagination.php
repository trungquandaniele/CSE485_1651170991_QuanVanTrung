
<?php 
     $tt=1;
     if(isset($_GET['page'])){$tt=$_GET['page'];}
?>
<ul class="pagination pagination float-right mt-2">
  <li class="page-item"><a class="page-link" href="?item=<?php echo $item; ?>&page=1">Trang đầu</a></li>
  <?php for($i=1; $i<=$pages;$i++){ 
  

  if(($i)==$tt):?>

<li class="page-item active"><a class="page-link" href="?item=<?php echo $item; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
  <?php else: if(($i>=($tt-2))&&($i<=($tt+2))): ?>
           <li class="page-item"><a class="page-link" href="?item=<?php echo $item; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          

  <?php endif;endif;} ?>
  <li class="page-item"><a class="page-link" href="?item=<?php echo $item; ?>&page=<?php echo $pages; ?>">Trang cuối</a></li>
</ul>