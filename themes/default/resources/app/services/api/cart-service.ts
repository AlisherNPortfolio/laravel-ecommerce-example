import type ISuccessPaginationResponse from '~/contracts/common/http/ISuccessPaginationResponse'
import {useHttpFetch} from '~/composables/useHttpFetch';
import type { ICart, ICartForm } from '~/contracts/pages/ICart';
import type { IPaginationParams } from '~/contracts/common/http/IApiData';

const http = useHttpFetch();
class CartService {
    private url: string = 'carts';

    add(data: ICartForm): Promise<ISuccessPaginationResponse<any>> {
        return http.post(`${this.url}`, data)
        .then((res: any) => res.data)
    }

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<ICart[]>>
    {
        return http.get(`${this.url}`, {data})
        .then((res: any) => res.data)
    }
}

export default new CartService();
