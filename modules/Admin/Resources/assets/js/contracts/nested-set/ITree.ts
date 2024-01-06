import INestedSet from "./INestedSet";

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
