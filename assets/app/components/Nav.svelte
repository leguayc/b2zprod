<script>
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

</script>

<nav>
    <div><img src="./assets/images/logo.svg" alt="b2z production logo" class="logo"></div>
    <div class="contain-menu"><img src="./assets/images/menu.png" alt="menu" class="menu"></div>
    <button on:click={() => { currentLanguage.update(current => current === 'en' ? 'fr' : 'en') }}>{$currentLanguage}</button>
</nav>