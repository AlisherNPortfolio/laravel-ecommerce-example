import INestedSet from "../nested-set/INestedSet";

export interface ICategory extends INestedSet {
    id?: number|null,
    name: string|null,
    slug?: string|null,
    is_active: boolean|null,
    order: number|null,
    meta_keywords: string|null,
    meta_description: string|null
}
