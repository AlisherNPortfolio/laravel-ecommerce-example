export interface IPaymentType {
    id?: number|null,
    name: string|null,
    image: string|File|null,
    is_active: boolean,
    order?: number|null,
    settings: IPaymentTypeSetting[]
}

export interface IPaymentTypeSetting {
    id?: number|null,
    payment_type_id: number|null,
    key: string|null,
    value: string|boolean|number|null,
    field_type: string|null
}
