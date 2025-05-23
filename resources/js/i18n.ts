import { createI18n } from 'vue-i18n';

const enModules = import.meta.glob('./locales/en/*.json', { eager: true }) as Record<string, { default: any }>;
const esModules = import.meta.glob('./locales/es/*.json', { eager: true }) as Record<string, { default: any }>;

function mergeModules(modules: Record<string, { default: any }>) {
    return Object.entries(modules).reduce((acc, [path, mod]) => {
        // Extraer el nombre del archivo para usarlo como namespace
        const fileName = path.split('/').pop()?.replace('.json', '') ?? '';
        acc[fileName] = mod.default;
        return acc;
    }, {} as Record<string, any>);
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
