<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import SocialMedia from '../components/SocialMedia.svelte';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();
</script>

<Nav/>

<main class="bg-texture">

    <Header title="{$t('Contact.Title')}" subtitle="{$t('Contact.SubTitle')}"/>

    <section class="contain">
        <h3 class="title">{$t('Contact.Content.Title')}</h3>
        <p class="text">{$t('Contact.Content.Text')}</p>
    </section>

    <section class="contact-maps">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5300.254857023524!2d2.352371545780338!3d48.789545203566156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67159601dc297%3A0xa9b3ac4aee831ca1!2s8%20Prom.%20Edouard%20Toulouse%2C%2094800%20Villejuif!5e0!3m2!1sfr!2sfr!4v1655295303293!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        <div class="content bg-black">
            <div><img src="./assets/images/phone.png" alt="location"><p class="title">{$t('Contact.Phone.Title')}</p></div>
            <p class="text"><a href="tel:0000000000" target="_blank">{$t('Contact.Phone.Text')}</a></p>
            <div><img src="./assets/images/mail.png" alt="location"><p class="title">{$t('Contact.Mail.Title')}</p></div>
            <p class="text"><a target="_blank" href="mailto:contact@b2z.com">{$t('Contact.Mail.Text')}</a></p>
            <div><img src="./assets/images/pin.png" alt="location"><p class="title">{$t('Contact.Address.Title')}</p></div>
            <p class="text"><a href="https://www.google.com/maps/search/?api=1&query={$t('Contact.Address.Text')}" target="_blank">{$t('Contact.Address.Text')}</a></p>
        </div>

    </section>

  <SocialMedia/>

</main>