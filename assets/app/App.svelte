<script>
    import Scene3D from  './components/Scene3D.svelte';

    let count = 0;
    $: doubled = count * 2;

    function handleClick() {
        count += 1;
    }

    console.log('hello');
</script>

<Scene3D />

<h1>Hello</h1>
<button on:click={handleClick}>
    Clicked {count} {count === 1 ? 'time' : 'times'}
</button>

<p>{count} doubled is {doubled}</p>