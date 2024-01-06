import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import { IBrand } from '../../contracts/pages/IBrands';

class ProductService implements ICRUD<IPaginationParams<any>, FormData, IBrand> {
    private url = '/api/admin/brands';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<IBrand[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<IBrand>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: FormData): Promise<ISuccessResponse<IBrand>> {
        return http.post(`${this.url}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    update(data: FormData, id: number): Promise<ISuccessResponse<IBrand>> {
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

    all(): Promise<ISuccessResponse<IBrand[]>> {
        return http.get(`${this.url}/all/list`)
        .then(res => res.data);
    }
}

export default new ProductService();
