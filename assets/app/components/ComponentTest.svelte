<script>
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let i18n;

</script>

<h3>{$t('Hello')}</h3>
<p>Component Test, à retirer quand on aura mis un vrai component (il sert juste pour avoir l'architecture)</p>
<p>Un component est un composant svelte que l'on peut réutiliser dans d'autres components, ou dans des views</p>