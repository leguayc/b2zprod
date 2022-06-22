<script>
    import { Router, Route } from "svelte-routing";
    import { initLocalizationContext } from './i18n';

    import Contact from './views/Contact.svelte';
    import About from './views/About.svelte';
    import Talent from './views/Talent.svelte';
    import Project from './views/Project.svelte';
    import News from './views/News.svelte';
    import ListNews from './views/ListNews.svelte';
    import Scene3D from './components/Scene3D.svelte';
    
    let isI18nLoaded = false;
    initLocalizationContext((e) => {
        if (Object.keys(e).length > 0) { // Check if event response is not empty
            isI18nLoaded = true;
        }
    });


</script>

{#if isI18nLoaded }

    <Router>
        <div>
            <Route path="/"><Scene3D /></Route>
            <Route path="/news/:id" component="{News}" />
            <Route path="/news" component="{ListNews}" />
            <Route path="/project/:id" component="{Project}" />
            <Route path="/talent" component="{Talent}" />
            <Route path="/about" component="{About}" />
            <Route path="/contact" component="{Contact}" />
        </div>
      </Router>

{/if}



