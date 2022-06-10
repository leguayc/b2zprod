<script>
    import Scene3D from  './components/Scene3D.svelte';
    import ComponentTest from './components/ComponentTest.svelte';
    import { initLocalizationContext } from './i18n';
    let isI18nLoaded = false;
    initLocalizationContext(() => {
        isI18nLoaded = true;
    });

    let count = 0;
    $: doubled = count * 2;

    function handleClick() {
        count += 1;
    }
</script>

<Scene3D />

{#if isI18nLoaded }
    <ComponentTest />
{/if}