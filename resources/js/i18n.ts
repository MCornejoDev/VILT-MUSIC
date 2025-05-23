import { createI18n } from 'vue-i18n';

const enModules = import.meta.glob('./locales/en/*.json', { eager: true }) as Record<string, { default: any }>;
const esModules = import.meta.glob('./locales/es/*.json', { eager: true }) as Record<string, { default: any }>;

function mergeModules(modules: Record<string, { default: any }>) {
    return Object.values(modules).reduce((acc, mod) => {
        return { ...acc, ...mod.default };
    }, {});
}

const messages = {
    en: mergeModules(enModules),
    es: mergeModules(esModules),
};

export const i18n = createI18n({
    legacy: false,
    locale: 'en', // idioma por defecto, puedes cambiar dinámicamente
    fallbackLocale: 'en',
    messages,
});
