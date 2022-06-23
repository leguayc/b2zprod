<script>
    export let title, subtitle, image;
</script>

<section class="contain-title gs_reveal gs_reveal_fromBottom">
    <h1>{title}</h1>
    <h3>{subtitle}</h3>
    <img src={image} alt={title}>
</section>