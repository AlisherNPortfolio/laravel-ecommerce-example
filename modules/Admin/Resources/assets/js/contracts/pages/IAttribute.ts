export interface IAttribute {
    id?: number|null,
    name: string|null,
    values: IAttributeValue[]
}

export interface IAttributeValue {
    id?: number|null,
    attribute_id?: number|null,
    value: string|number|null
}