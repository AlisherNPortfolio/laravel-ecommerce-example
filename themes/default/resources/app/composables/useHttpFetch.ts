import merge from 'lodash/merge';

export const useHttpFetch = () => {
    const runtimeConfig = useRuntimeConfig();
    const headers: HeadersInit = {
        Accept: 'application/json'
    };

    if (process.server) {
        const token = null;

        if (token) {
            headers.Authorization = `Bearer ${token}`;
        }
    }

    const config: FetchOptions = {
        baseURL: runtimeConfig.public.baseApiURL,
        credentials: 'omit',
        headers,
        retry: 1
    }

    const instance = $fetch.create(config);

    const httpClient = {
        get: <T=unknown> (url: string, params?: SearchParams, headers?: HeadersInit): Promise<T> => {
            return instance(url, merge(config, {
                method: 'get',
                headers,
                params
            }))
        },
        post: <T = unknown> (url: string, body?: FetchBody, headers?: HeadersInit): Promise<T> => {
            return instance(url, merge(config, {
              method: 'post',
              headers,
              body,
            }))
          },
          put: <T = unknown> (url: string, body?: FetchBody, headers?: HeadersInit): Promise<T> => {
            return instance(url, merge(config, {
              method: 'put',
              headers,
              body,
            }))
          },
          patch: <T = unknown> (url: string, body?: FetchBody, headers?: HeadersInit): Promise<T> => {
            return instance(url, merge(config, {
              method: 'patch',
              headers,
              body,
            }))
          },
          delete: <T = unknown> (url: string, params?: SearchParams, headers?: HeadersInit): Promise<T> => {
            return instance(url, merge(config, {
              method: 'delete',
              headers,
              params,
            }))
          },
    }

    return httpClient;
}
