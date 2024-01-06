import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import { IPaymentType } from '../../contracts/pages/IPaymentType';

class PaymentTypeService implements ICRUD<IPaginationParams<any>, FormData, IPaymentType> {
    private url = '/api/admin/payment-types';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<IPaymentType[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<IPaymentType>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: FormData): Promise<ISuccessResponse<IPaymentType>> {
        return http.post(`${this.url}`, data, {
            'headers': {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    update(data: FormData, id: number): Promise<ISuccessResponse<IPaymentType>> {
        data.append('_method', 'PUT');

        return http.post(`${this.url}/${id}`, data, {
            'headers': {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<boolean>> {
        return http.delete(`${this.url}/${id}`)
        .then(res => res.data);
    }

    all(): Promise<ISuccessResponse<IPaymentType[]>> {
        return http.get(`${this.url}/all/list`)
        .then(res => res.data);
    }
}

export default new PaymentTypeService();
