import { IPaginationParams } from '../../contracts/IApiData';
import http from '../../http-common';
import ICRUD from '../../contracts/services/ICRUD';
import ISuccessResponse from '../../contracts/responses/ISuccessResponse';
import ISuccessPaginationResponse from '../../contracts/responses/ISuccessPaginationResponse';
import { IProduct, IProductMediaResponse } from '../../contracts/pages/IProduct';

class ProductService implements ICRUD<IPaginationParams<any>, FormData, IProduct> {
    private url = '/api/admin/products';

    pagination(data: IPaginationParams<any>): Promise<ISuccessPaginationResponse<IProduct[]>> {
        return http.get(`${this.url}`, {data})
        .then(res => res.data);
    }

    get(id: number): Promise<ISuccessResponse<IProduct>> {
        return http.get(`${this.url}/${id}`)
        .then(res => res.data);
    }
    add(data: FormData): Promise<ISuccessResponse<IProduct>> {
        return http.post(`${this.url}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    update(data: FormData, id: number): Promise<ISuccessResponse<IProduct>> {
        data.append('_method', 'PUT');

        return http.post(`${this.url}/${id}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }
    remove(id: number): Promise<ISuccessResponse<boolean>> {
        return http.delete(`${this.url}/${id}`)
        .then(res => res.data);
    }

    uploadImages(data: FormData): Promise<ISuccessResponse<IProductMediaResponse[]>>
    {
        return http.post(`${this.url}/upload-images`, data, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(res => res.data);
    }

    deleteImages(images: string[]): Promise<ISuccessResponse<any>>
    {
        return http.post(`${this.url}/delete-images`, {paths: images.map(img => `public/${img}`)})
        .then(res => res.data);
    }

    saveVariants(form: any) {
        return http.post(`${this.url}/skus`, form)
        .then(res => res.data);
    }
}

export default new ProductService();
