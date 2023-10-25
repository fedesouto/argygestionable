<?php
defined( 'ABSPATH' ) || exit;

?>

<script>
    const products = document.querySelectorAll('.products')[0];

    function filterProducts(color){

    jQuery.ajax({
    type: 'POST',
    url: '/argygestionable/wp-admin/admin-ajax.php',
    dataType: 'text',
    data: {
      action: 'filter_products',
      color: color
    },
    success: function(res) {
      jQuery('.products').html(res);
    },
    error: function(err) {
      console.log(err);
    }
  });
}
</script>
<p>
    <button onclick="filterProducts('blue')">Blue</button>
    <button onclick="filterProducts('red')">Red</button>
</p>