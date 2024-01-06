import {defineStore} from 'pinia'
const config = useRuntimeConfig();
export const useGlobalsStore = defineStore('globals', {
    state: () => ({
        imgBaseUrl: config.public.baseURL + '/storage/'
    })
})
