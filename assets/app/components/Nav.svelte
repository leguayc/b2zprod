<script>
    import { getLocalization } from '../i18n';
    import langs from '../../../public/locales/langs.json';
    const { t, currentLanguage } = getLocalization();

    let allLangs = langs.allLangs;
    let selectedLang = currentLanguage;

    let m = { x: 0, y: 0 };

	const handleMousemove = (event) => {
		m.x = event.pageX;
		m.y = event.pageY;
	}

</script>

<nav>
    <a href="/"><img src="/assets/images/logo.svg" alt="b2z production logo" class="logo"></a>
     <a href="/?r=menu" class="contain-menu"><img src="/assets/images/menu.png" alt="menu" class="menu"></a>
</nav>

<div class="options">
    <select bind:value={$selectedLang} on:change="{() => currentLanguage.set(selectedLang)}">
		{#each allLangs as lang}
			<option value={lang} selected>
				{lang}
			</option>
		{/each}
	</select>

    <div class="btn-xs btn-orange trophy">
        <a href="/?r=trophy" class="text"><img src="/assets/images/trophy.png" alt="trophee"></a>
    </div>
</div>

<svelte:window on:mousemove={handleMousemove}/>

<div id="cursor" style="left: {m.x}px; top: {m.y}px;" ></div>


