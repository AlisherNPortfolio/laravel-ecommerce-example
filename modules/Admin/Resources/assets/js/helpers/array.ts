class ArrayHelper {
    uniqueElements(arr) {
        return [...new Set(arr)];
    }

    isEqual(arr1, arr2) {
        return arr1.reduce((a, b) => a && arr2.includes(b), true);
    }
}

export default new ArrayHelper();
