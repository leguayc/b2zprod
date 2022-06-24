<script>
    import { getLocalization } from '../i18n';
    const { t, currentLanguage } = getLocalization();

</script>

<footer>
    <div class="contain-footer">
        <div>
            <ul>
                <li class="name">{$t('Site.Map')} :</li>
                <li><a href="/">{$t('ListNews.Title')}</a></li>
                <li><a href="/about">{$t('About.Title')}</a></li>
                <li><a href="/?r=projects">{$t('Projects.Title')}</a></li>
                <li><a href="/news">{$t('ListNews.Title')}</a></li>
                <li><a href="/about#presse">{$t('Presse.Title')}</a></li>
                <li><a href="/talent">{$t('Talent.Title')}</a></li>
                <li><a href="/contact">{$t('Contact.Title')}</a></li>
                <li><a href="/?r=trophy">{$t('Trophee.Title')}</a></li>
            </ul>
        </div>
        <div><img src="./assets/images/logo.svg" alt="b2z production logo" class="logo"></div>
        <div>
            <ul>
                <li class="name">{$t('Project.Producer')} :</li>
                <li><a href="https://leguayc.com/" target="_blank">Corentin Leguay</a></li>
                <li><a href="https://paulmarechal.xyz/" target="_blank">Paul Maréchal</a></li>
                <li><a href="https://elisewillekens.fr/" target="_blank">Elise Willekens</a></li>                   
            </ul>
        </div>
    </div>
    <div class="footer">
        <div><a href="/mentions-legales">{$t('Legales.Title')} - © 2022</a></div>
    </div>
</footer>