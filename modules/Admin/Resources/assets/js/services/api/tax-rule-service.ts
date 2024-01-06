import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import {ITaxRule} from '../../contracts/pages/ITaxRule';

class TaxRuleService implements ICRUD<IPaginationParams<any>, ITaxRule, ITaxRule> {
    private url = '/api/admin/tax-rules';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<ITaxRule[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<ITaxRule>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: ITaxRule): Promise<ISuccessResponse<ITaxRule>> {
        return http.post(`${this.url}`, data)
        .then(res => res.data);
    }
    update(data: ITaxRule, id: number): Promise<ISuccessResponse<ITaxRule>> {
        return http.post(`${this.url}/${id}`, data)
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<boolean>> {
        throw new Error('Method not implemented.');
    }

    all(): Promise<ISuccessResponse<ITaxRule[]>> {
        return http.get(`${this.url}/all/list`)
        .then(res => res.data);
    }
}

export default new TaxRuleService();
