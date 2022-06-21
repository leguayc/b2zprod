<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import SocialMedia from '../components/SocialMedia.svelte';
    import Footer from "../components/Footer.svelte";
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();
</script>

<Nav/>

<main class="bg-texture">

    <Header title="Salle de contact" subtitle="B2Z Production"/>

    <section class="contain">
        <h3 class="title">Titre d'une partie</h3>
        <p class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
    </section>

    <section class="contact-maps">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5300.254857023524!2d2.352371545780338!3d48.789545203566156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67159601dc297%3A0xa9b3ac4aee831ca1!2s8%20Prom.%20Edouard%20Toulouse%2C%2094800%20Villejuif!5e0!3m2!1sfr!2sfr!4v1655295303293!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        <div class="content bg-black">
            <div><img src="./assets/images/phone.png" alt="location"><p class="title">Téléphone</p></div>
            <p class="text"><a href="tel:0000000000" target="_blank">00 00 00 00 00</a></p>
            <div><img src="./assets/images/mail.png" alt="location"><p class="title">Mail</p></div>
            <p class="text"><a target="_blank" href="mailto:contact@b2z.com">contact@b2z.com</a></p>
            <div><img src="./assets/images/pin.png" alt="location"><p class="title">Adresse</p></div>
            <p class="text"><a href="https://www.google.com/maps/search/?api=1&query=8 Promenade Edouard Toulouse 94800 Villejuif" target="_blank">8 Promenade Edouard Toulouse 94800 Villejuif</a></p>
        </div>

    </section>

    <SocialMedia/>


</main>

<Footer/>