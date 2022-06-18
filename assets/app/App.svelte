<script>
   
    import { initLocalizationContext } from './i18n';

    import Contact from './views/Contact.svelte';
    import About from './views/About.svelte';
    import Talent from './views/Talent.svelte';
    import Project from './views/Project.svelte';
    import News from './views/News.svelte';
    import ListNews from './views/ListNews.svelte';
    
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

{#if isI18nLoaded }

    <Project/>

{/if}



