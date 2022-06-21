import { derived, writable } from 'svelte/store';

export class I18NextTranslationService {
    locale;
    translate;

    constructor(i18n) {
        this.locale = this.createLocale(i18n);
        this.translate = this.createTranslate(i18n);
    }

    // Locale initialization. 
    // 1. Create a writable store
    // 2. Create a new set function that changes the i18n locale.
    // 3. Create a new update function that changes the i18n locale.
    // 4. Return modified writable.
    createLocale(i18n) {
        const { subscribe, set, update } = writable('fr');

        const setLocale = (newLocale) => {
            i18n.changeLanguage(newLocale);
            set(newLocale);
        };

        const updateLocale = (updater) => {
            update(currentValue => {
                const nextLocale = updater(currentValue);
                i18n.changeLanguage(nextLocale);
                return nextLocale;
            });
        };

        return {
            subscribe,
            update: updateLocale,
            set: setLocale,
        };
    }

    // Create a translate function.
    // It is derived from the "locale" writable.
    // This means it will be updated every time the locale changes.
    createTranslate(i18n) {
        return derived([this.locale], () => {
            return (key, replacements) => i18n.t(key, replacements);
        });
    }
}