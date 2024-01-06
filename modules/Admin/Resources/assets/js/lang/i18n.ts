import { createI18n } from "vue-i18n";
import uz from "./uz";
import en from "./en";
import ru from "./ru";

const i18n = createI18n({
   legacy: false,
   locale: 'uz' ,
   globalInjection: true,
   messages: { uz, en, ru }
});

export default i18n;
