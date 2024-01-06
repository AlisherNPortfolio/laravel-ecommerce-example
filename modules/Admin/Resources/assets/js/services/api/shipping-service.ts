import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import {IShipping} from '../../contracts/pages/IShipping';

class ShippingService implements ICRUD<IPaginationParams<any>, IShipping, IShipping> {
    private url = '/api/admin/shippings';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<IShipping[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<IShipping>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: IShipping): Promise<ISuccessResponse<IShipping>> {
        return http.post(`${this.url}`, data)
        .then(res => res.data);
    }
    update(data: IShipping, id: number): Promise<ISuccessResponse<IShipping>> {
        return http.post(`${this.url}/${id}`, data)
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<boolean>> {
        throw new Error('Method not implemented.');
    }

    all(): Promise<ISuccessResponse<IShipping[]>> {
        return http.get(`${this.url}/all/list`)
        .then(res => res.data);
    }
}

export default new ShippingService();
