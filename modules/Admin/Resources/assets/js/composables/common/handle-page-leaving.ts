import notify from "../../helpers/notify";

import { onBeforeRouteLeave } from "vue-router";

import { Ref, UnwrapNestedRefs, watch, toRaw } from "vue";

export default function useHandlePageLeaving() {
    function handleOnPageLeaving(watchingData: UnwrapNestedRefs<any>, originalData: UnwrapNestedRefs<any>,  isDataChanged: Ref<any>, callback) {

        // watch if data inserted into a form
        watch(watchingData, (val, oldVal) => {
            isDataChanged.value = isFormChanged(watchingData, originalData);//console.log('t', isDataChanged.value)
        }, {deep: true});

        // warn a user if he wants to go to another route
        onBeforeRouteLeave((to, from, next) => {
            if (isDataChanged.value) {
                if (confirm('You are leaving the page without saving changes! Are you sure to leave the page?')) {
                    document.dispatchEvent(new Event('do.action'));
                    next();
                }
            } else {
                next();
            }
        });

        // warn a user if he wants to reload or leave a page
        // @ts-ignore
        const myEvent = window.attachEvent || window.addEventListener;
        //@ts-ignore
        const chkevent = window.attachEvent ? 'onbeforeunload' : 'beforeunload'; /// make IE7, IE8 compitable

        myEvent(chkevent, function(e) { // For >=IE7, Chrome, Firefox
            if (isDataChanged.value) {
                e.preventDefault();
                 const confirmationMessage = 'Are you sure to leave the page?';  // a space
                 e.returnValue = confirmationMessage;
                 document.dispatchEvent(new Event('do.action'));
                 return confirmationMessage;
            }
        });

        document.addEventListener('do.action', function () {
            callback();
        })
    }

    const isFormChanged = (changed: UnwrapNestedRefs<Object>, original: UnwrapNestedRefs<Object>) => {
        const checkingBag: boolean[] = [];
        // console.log('obj keys', Object.values(changed), Object.values(original))
        Object.keys(changed).forEach(k => {

            let chng: any = toRaw(changed[k]);
            let org: any = toRaw(original[k])
            if (Array.isArray(chng)) {
                chng = JSON.stringify(chng);
                org = JSON.stringify(org)
            }
            // console.log('org', org, 'changed', chng, 'comp', chng === org || chng === '')
            checkingBag.push(chng === org || chng === '');
        });
        // console.log('chan', checkingBag)
        return checkingBag.includes(false);
    }

    return {
        handleOnPageLeaving
    }
}
