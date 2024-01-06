import ITree, { ITreeFields } from "../contracts/nested-set/ITree";
import { ICategoryTree } from "../contracts/pages/IBanners";

export default function tree_maker(data: ICategoryTree[], fields: ITreeFields[] = [], checkboxAll: boolean = false) {
    const result: ITree[] = [];

    for (let i = 0; i < data.length; i++) {
        const children = data[i].children ? Object.values(data[i].children) : [];
        const hasChildren: boolean = children.length > 0;
        const item: ITree = {
            label: data[i].name,
            children: tree_maker(children, fields, checkboxAll)
        };

        if (hasChildren && !checkboxAll) {
            item['tickable'] = true;
            item['selectable'] = false;
            item['noTick'] = true;
        }

        if (data[i].parent_id == null) {
            item['noTick'] = true;
        }

        if (fields.length) {
            fields.forEach(f => {
                item[f.tree_key] = data[i][f.data_key];
            })
        }

        result.push(item);
    }

    return result;
}
