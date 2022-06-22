<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import SocialMedia from '../components/SocialMedia.svelte';
    import Footer from "../components/Footer.svelte";
    
    import { onMount } from 'svelte';
    import {gsapInit} from '../helpers/GsapHelper.js';
    
    import axios from 'axios';
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

    let firstname;
    let lastname;
    let email;
    let phoneNumber;
    let scenarioFile;
    let pitch;
    let message;

    const onSubmit = async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("firstname", firstname);
        formData.append("lastname", lastname);
        formData.append("email", email);
        formData.append("phoneNumber", phoneNumber);
        formData.append("file", scenarioFile[0]);
        formData.append("summary", pitch);
        formData.append("stuffToAdd", message);

        try {
            const response = await axios({
                method: "post",
                url: "/api/scenarios",
                data: formData,
                headers: { "Content-Type": "multipart/form-data" },
            });

            if (response.status == 201) {
                // Success, display a message to user ?
                console.log("Success !");
            }
        } catch(error) {
            console.log("error");
        }
    }

    onMount(async () => {
        gsapInit();        
    });

</script>


<Nav/>

<main class="bg-texture">

    <Header title="{$t('Talent.Title')}" subtitle="B2Z Production"/>

    <section class="contain gsap-reveal gs_reveal gs_reveal_fromRight">
        <h3 class="title">{$t('Talent.Content.Title')}</h3>
        <p class="text">{$t('Talent.Content.Text')}</p>
    </section>

    <section class="form-script gsap-reveal gs_reveal gs_reveal_fromLeft">
        <h3 class="title">{$t('Talent.Send')}</h3>
        <form action="#" class="form-group">
            <div class="form-item">
                <label for="prenom">{$t('Talent.Form.Firstname')}</label>
                <input type="text" name="prenom" placeholder="{$t('Talent.Form.Firstname')}*" required>
            </div>
            <div class="form-item">
                <label for="email">{$t('Talent.Form.LastName')}</label>
                <input type="text" name="email" placeholder="{$t('Talent.Form.Lastname')}*" required>
            </div>
            <div class="form-item">
                <label for="mail">{$t('Talent.Form.Email')}</label>
                <input type="mail" name="mail" placeholder="Email*">
            </div>
            <div class="form-item">
                <label for="phone">{$t('Talent.Form.Phone')}</label>
                <input type="tel" name="phone" placeholder="{$t('Talent.Form.Phone')}">
            </div>
            <div class="form-item form-item--100">
                <label for="file">{$t('Talent.Form.Scenario')}</label>
                <input type="file" accept=".pdf" name="file">
            </div>
            <div class="form-item form-item--100">
                <label for="pitch">{$t('Talent.Form.Pitch')}</label>
                <textarea name="pitch" cols="20" rows="10" placeholder="{$t('Talent.Form.Pitch.Placeholder')}"></textarea>
            </div>
            <div class="form-item form-item--100">
                <label for="message">{$t('Talent.Form.Message')}</label>
                <textarea name="message" cols="30" rows="10" placeholder="{$t('Talent.Form.Message.Placeholder')}"></textarea>
            </div>
            <button type="submit" class="btn btn-orange">{$t('Talent.Send')}</button>
        </form>
    </section>

   <SocialMedia/>

</main>
<Footer/>