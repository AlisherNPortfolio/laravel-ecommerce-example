import {notify} from '@kyvg/vue3-notification';

const duration: number = 3000;

export default {
    success: (message: string) => {
        notify({
            title: 'Success!',
            type: 'success',
            text: message,
            duration
        })
    },
    error: (message: string) => {
        notify({
            title: 'Error!',
            type: 'error',
            text: message,
            duration
        })
    },
    warn: (message: string) => {
        notify({
            title: 'Warning!',
            type: 'warn',
            text: message,
            duration
        })
    }
}
