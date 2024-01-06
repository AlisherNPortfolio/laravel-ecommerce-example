import type { IProduct } from "./IProduct"

export interface ICart {
    id?: number|null,
    user_id?: number|null,
    productId: number|null,
    image: string|null,
    productName: string|null,
    price: number|null,
    qty: number|null,
    total: number|null
}

export interface ICartDb {
    id: number,
    user_id: number,
    items: ICartItemDb[]
}

export interface ICartItemDb {
    id: number,
    cart_id: number,
    product_id: number,
    qty: number,
    product: IProduct
}

export interface ICartForm {
    product_id: number,
    qty?: number
}
