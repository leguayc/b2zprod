import i18next from 'i18next';
import HttpApi from 'i18next-http-backend';
import langs from '../../../public/locales/langs.json';
import LanguageDetector from 'i18next-browser-languagedetector';

export class I18nService {
    // expose i18next
    i18n;

    constructor() {
        this.i18n = i18next;
        this.initialize();
    }

    // Our translation function
    t(key, replacements) {
        return this.i18n.t(key, replacements);
    }

    // Initializing i18n
    initialize() {
        this.i18n
        .use(HttpApi)
        .use(LanguageDetector)
        .init({
            load: 'languageOnly',
            preload: langs.allLangs,
            saveMissing: true,
            fallbackLng: 'fr',
            debug: false,
            interpolation: {
                escapeValue: true,
            },
            backend: {
                loadPath: '/locales/{{lng}}/{{ns}}.json',
                reloadInterval: false
            }
        });
    }

    changeLanguage(language) {
        this.i18n.changeLanguage(language);
    }
}
