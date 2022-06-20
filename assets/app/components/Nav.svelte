<script>
    import { getLocalization } from '../i18n';
    import langs from '../../../public/locales/langs.json';
    const { t, currentLanguage } = getLocalization();

    const changeLang = () => {
        currentLanguage.update(current => {
            let allLangs = langs.allLangs;
            for(let i = 0; i < allLangs.length; i++) {
                if (allLangs[i] === current) {
                    return i + 1 < allLangs.length ? allLangs[i + 1] : allLangs[0];  
                }
            }
        });
    };
</script>

<nav>
    <a href="/"><img src="/assets/images/logo.svg" alt="b2z production logo" class="logo"></a>
    <a href="/" class="contain-menu"><img src="/assets/images/menu.png" alt="menu" class="menu"></a>
    <button on:click={changeLang}>{($currentLanguage).toUpperCase()}</button>
</nav>