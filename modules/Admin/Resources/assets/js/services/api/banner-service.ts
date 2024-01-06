import http from '../../http-common'
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import {IPaginationParams} from '../../contracts/IApiData';
import { Banner } from '../../contracts/pages/IBanners';
import ICRUD from '../../contracts/services/ICRUD';

class BannerService implements ICRUD<IPaginationParams<any>, FormData, Banner> {

    private url = '/api/admin/banners';

    add(data: FormData): Promise<ISuccessResponse<any>> {
        return http.post(`${this.url}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }

    update(data: FormData, id: number): Promise<ISuccessResponse<any>> {
        data.append('_method', 'PUT');
        return http.post(`${this.url}/${id}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<Banner[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<Banner>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }

    remove(id: number): Promise<ISuccessResponse<boolean>> {
        return http.delete(`${this.url}/${id}`)
        .then(res => res.data);
    }

    removeItem(id: number): Promise<ISuccessResponse<any>>
    {
        return http.delete(`${this.url}/item/${id}`)
        .then(res => res.data);
    }
}

export default new BannerService();
