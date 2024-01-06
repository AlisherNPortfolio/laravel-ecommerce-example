import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import {IAttribute} from '../../contracts/pages/IAttribute';

class AttributeService implements ICRUD<IPaginationParams<any>, IAttribute, IAttribute> {
    private url = '/api/admin/attributes';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<IAttribute[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<IAttribute>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: IAttribute): Promise<ISuccessResponse<IAttribute>> {
        return http.post(`${this.url}`, data)
        .then(res => res.data);
    }
    update(data: IAttribute, id: number): Promise<ISuccessResponse<IAttribute>> {
        data['_method'] = 'PUT';
        return http.post(`${this.url}/${id}`, data)
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<IAttribute>> {
        throw new Error('Method not implemented.');
    }

    all(): Promise<ISuccessResponse<IAttribute[]>> {
        return http.get(`${this.url}/all/list`)
        .then(res => res.data);
    }
}

export default new AttributeService();
