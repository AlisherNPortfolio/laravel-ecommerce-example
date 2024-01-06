import INestedSet from "../nested-set/INestedSet"

export interface Banner {
    id?: number | null,
    name: string | null,
    slug: string | null,
    is_active: boolean | true,
    banners?: BannerItem[]
}

export interface BannerItem {
    id?: number | null,
    banner_id: number | null,
    title: string | null,
    short_description?: string | null,
    description?: string | null,
    button?: string | null,
    link?: string | null,
    image?: File | null,
    is_active?: boolean | null,
    meta_keywords?: string | null,
    meta_description?: string | null
}

export interface ICategoryTreeItem extends INestedSet {
    id: number,
    name: string,
    slug: string,
    order: number,
    icon: string|null
}

export interface ICategoryTree extends ICategoryTreeItem {
    children: ICategoryTree[]
}
