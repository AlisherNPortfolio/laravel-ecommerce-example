export interface IBrand {
    id?: number|null;
    name: string|null;
    slug: string|null;
    description: string|null;
}

export interface INestedSet {
    lft?: number|null,
    rgt?: number|null,
    parent_id?: number|null,
    position?: number|null
}

export interface ICategory extends INestedSet {
    id?: number|null,
    name: string|null,
    slug?: string|null,
    is_active: boolean|null,
    order: number|null,
    meta_keywords: string|null,
    meta_description: string|null,
    icon?: string|null,
    product_qty?: number
}

export interface ITreeItem {
    id?: number|null,
    label: string|null,
    icon?: string|null,
    avatar?: string|null,
    body?: string,
    header?: string,
    slug?: string
}

export interface ITreeFields {
    tree_key: string,
    data_key: string
}

export default interface ITree extends ITreeItem {
    children: ITree[],
    selectable?: boolean,
    tickable?: boolean,
    noTick?: boolean
}
