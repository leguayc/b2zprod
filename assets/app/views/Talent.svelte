<script>
    import Nav from '../components/Nav.svelte';
    import Header from '../components/Header.svelte';
    import Footer from '../components/Footer.svelte';
    import SocialMedia from '../components/SocialMedia.svelte';

    
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
</script>

<Nav/>

<main class="bg-texture">

    <Header title={$t('Talent.Title')} subtitle="B2Z Production"/>

    <section class="contain">
        <h3 class="title">{$t('Talent.Content.Title')}</h3>
        <p class="text">{$t('Talent.Content.Text')}</p>
    </section>

    <section class="form-script">
        <h3 class="title">{$t('Talent.Send')}</h3>
        <form method="POST" class="form-group" on:submit={onSubmit}>
            <div class="form-item">
                <label for="firstname">{$t('Talent.Form.Firstname')}*</label>
                <input type="text" name="firstname" placeholder="{$t('Talent.Form.Firstname')}*" required bind:value={firstname} />
            </div>
            <div class="form-item">
                <label for="lastname">{$t('Talent.Form.Lastname')}*</label>
                <input type="text" name="lastname" placeholder="{$t('Talent.Form.Lastname')}*" required bind:value={lastname} />
            </div>
            <div class="form-item">
                <label for="mail">{$t('Talent.Form.Email')}*</label>
                <input type="mail" name="mail" placeholder="{$t('Talent.Form.Email')}*" required bind:value={email} />
            </div>
            <div class="form-item">
                <label for="phoneNumber">{$t('Talent.Form.Phone')}*</label>
                <input type="tel" name="phoneNumber" placeholder="{$t('Talent.Form.Phone')}*" required bind:value={phoneNumber} />
            </div>
            <div class="form-item form-item--100">
                <label for="file">{$t('Talent.Form.Scenario')} (PDF)*</label>
                <input type="file" accept=".pdf" name="file" required bind:files={scenarioFile} />
            </div>
            <div class="form-item form-item--100">
                <label for="summary">{$t('Talent.Form.Pitch')}*</label>
                <textarea name="summary" cols="20" rows="10" placeholder="{$t('Talent.Form.Pitch.Placeholder')}*" required bind:value={pitch}></textarea>
            </div>
            <div class="form-item form-item--100">
                <label for="stuffToAdd">{$t('Talent.Form.Message')}</label>
                <textarea name="stuffToAdd" cols="30" rows="10" placeholder="{$t('Talent.Form.Message.Placeholder')}" bind:value={message}></textarea>
            </div>
            <button type="submit" class="btn btn-orange">{$t('Talent.Send')}</button>
        </form>
    </section>

   <SocialMedia/>

</main>

<Footer/>