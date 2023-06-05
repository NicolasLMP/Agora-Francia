<script>
  function redirectToProduct(name, price, image) {
    const url = `infoProduits.php?name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&image=${encodeURIComponent(image)}`;
    window.location.href = url;
  }
</script>