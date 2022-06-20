<script>
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

</script>

<nav>
    <a href="/"><img src="/assets/images/logo.svg" alt="b2z production logo" class="logo"></a>
    <a href="/" class="contain-menu"><img src="/assets/images/menu.png" alt="menu" class="menu"></a>
    <button on:click={() => { currentLanguage.update(current => current === 'en' ? 'fr' : 'en') }}>{$currentLanguage}</button>
</nav>