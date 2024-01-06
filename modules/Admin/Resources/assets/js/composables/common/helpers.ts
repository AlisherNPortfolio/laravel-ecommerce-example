import sluggable from "../../helpers/sluggable";
import { UnwrapNestedRefs, reactive } from 'vue';

export default function useHelpers() {
    const makeSlug = (e: any) => {
        return sluggable(e.target.value)
    }

    const cloneReactiveObj = <T>(obj): {form: UnwrapNestedRefs<T>, formCopy: UnwrapNestedRefs<T>} => {
        const main: UnwrapNestedRefs<T> = reactive(obj);
        const deepCopy: UnwrapNestedRefs<T> = reactive(JSON.parse(JSON.stringify(obj)));

        return {form: main, formCopy: deepCopy}
    }

    const arrayDifference = (a: any[], b: any[]) => {
        const s = new Set(b);
        return a.filter(x => !s.has(x));
    }


    return {
        makeSlug,
        cloneReactiveObj,
        arrayDifference
    }
}
