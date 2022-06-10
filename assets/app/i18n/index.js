import { getContext, setContext } from 'svelte';
import { I18nService } from './i18n-service';
import { I18NextTranslationService } from './translation-service';

export const initLocalizationContext = (onLoadedCallback) => {
    // Initialize our services
    const i18n = new I18nService();
    const tranlator = new I18NextTranslationService(i18n);
  
    // Setting the Svelte context
    setLocalization({
        t: tranlator.translate,
        currentLanguage: tranlator.locale,
    });

    // Do stuff when the resources are loaded
    i18n.i18n.on('loaded', onLoadedCallback);
  
    return {
        i18n,
    };
};

const CONTEXT_KEY = 't';

export const setLocalization = (context) => {
    return setContext(CONTEXT_KEY, context);
};

// To make retrieving the t function easier.
export const getLocalization = () => {
    return getContext(CONTEXT_KEY);
};
