<h1>Fechando sua sessão....</h1>
<?php 
session_destroy();
die("<script>location.href = 'https://www.citywatch.com.br/v1/'</script>");
?>