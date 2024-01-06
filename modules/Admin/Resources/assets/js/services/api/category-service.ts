import { IPaginationParams } from '../../contracts/IApiData';
import { ICategory } from '../../contracts/pages/ICategory';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import { ICategoryTree } from '../../contracts/pages/IBanners';
import { AxiosResponse } from 'axios';

class CategoryService implements ICRUD<IPaginationParams<any>, FormData, ICategory> {
    private url = '/api/admin/categories';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<ICategory[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<ICategory>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: FormData): Promise<ISuccessResponse<ICategory>> {
        return http.post(`${this.url}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    update(data: FormData, id: number): Promise<ISuccessResponse<ICategory>> {
        data.append('_method', 'PUT');
        return http.post(`${this.url}/${id}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<boolean>> {
        throw new Error('Method not implemented.');
    }

    getTree(): Promise<ISuccessResponse<ICategoryTree[]>> {
        return http.get(`${this.url}/tree-view`)
        .then(res => res.data);
    }
}

export default new CategoryService();
