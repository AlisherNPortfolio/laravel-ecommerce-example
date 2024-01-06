export interface IProduct {
    id?: number|null,
    name: string|null,
    slug: string|null,
    sku: string|null,
    price: number|null,
    discounted_price: number|null,
    cost: number|null,
    quantity: number|null,
    sell_out_of_stock: boolean,
    description: string|null,
    category_id: number|null,
    brand_id: number|null,
    is_active: boolean,
    meta_keywords: string|null,
    meta_description: string|null,
    measure_type: string|null,
    images: string[]|IProductMediaInDb[]|null,
    videos: string[]|IProductMediaInDb[]|null,

    preview: string|null,
    is_featured: boolean|null,
    is_new: boolean|null,
    is_popular: boolean|null,
    has_warranty: boolean|null,
    warranty_period: number|null,
    tax_rule_id: number|null,
    shipping_id: number|null,
    attribute_values?: IProductAttributeValue[]|IProductSkuInDB[]
}

export interface IProductMedia {
    media: File[],
    path: string
}

export interface IProductAttributeValue {
    id?: number|null,
    name: string,
    sku: string|null,
    price: number|null,
    quantity: number|null,
    values: number[]
}

export interface IProductMediaInDb {
    id: number,
    product_id: number,
    url: string,
    order: number,
    file_type: 1|2
}

export interface IProductMediaResponse {
    original: string,
    name: string
}

export interface IProductSkuInDB {
    id: number,
    product_id: number,
    sku: string,
    price: number,
    quantity: number,
    values: IProductAttributeValueInDB[]
}

export interface IProductAttributeValueInDB {
    id: number,
    attribute_id: number,
    value: string
}
