export interface IShipping {
    id?: number|null,
    name: string|null,
    rules?: IShippingRule[]
}

export interface IShippingRule {
    id?: number|null,
    shipping_id: number|null,
    region_id: number|null,
    district_id: number|null,
    price: number|null,
    shipping_hours: number|null,
    has_pickup_address: boolean,
    pickup_price: number|null,
    pickup_phone: string|null,
    pickup_city: string|null,
    pickup_address: string|null
}
