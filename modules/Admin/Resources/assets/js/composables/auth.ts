import {Ref, ref} from 'vue'
import { ILogin } from '../contracts/pages/IAuth';
import AuthService from '../services/api/auth-service';
import TokenService from '../services/TokenService';
import { useRouter } from 'vue-router';
import notify from '../helpers/notify';

export default function useAuth() {
    const router = useRouter();
    const form: Ref<ILogin> = ref({
        email: null,
        password: null
    });
    // ========== methods ===============
const login = () => {
    AuthService.login(form.value)
    .then(res => {
        if (res.success) {
            TokenService.saveToken(res.data.token);
            const permissions: string[] = res.data.permissions;
            TokenService.savePermissions(JSON.stringify(permissions));
            router.push({name: 'dashboard'})
        } else {
            notify.error('Login qilishda xatolik!');
        }
    })
}

return {
    form,
    // ======== methods ======
    login
}
}
